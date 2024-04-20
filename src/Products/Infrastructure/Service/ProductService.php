<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Service;

use App\Coupons\Domain\Repository\CouponRepositoryInterface;
use App\Coupons\Domain\Service\CouponServiceInterface;
use App\Products\Application\DTO\MarkdownedProductDTO;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use App\Products\Domain\Service\ProductServiceInterface;
use App\Tax\Domain\Service\TaxServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly CouponRepositoryInterface $couponRepository,
        private readonly TaxServiceInterface $taxService,
        private readonly CouponServiceInterface $couponService,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function getMarkdownedProduct(
        string $productName,
        string $couponCode,
        string $taxNumber,
    ): MarkdownedProductDTO
    {
        $product = $this->productRepository->findByName($productName);

        if (is_null($product)) {
            throw new \Exception('Product not found', 404);
        }

        $markdownedProductDTO = MarkdownedProductDTO::fromEntity($product);

        $coupon = $this->couponRepository->findByCode($couponCode);

        if (is_null($coupon)) {
            throw new \Exception('Coupon not found', 404);
        }

        $taxInfoDTO = $this->taxService->getTaxInfo($taxNumber);

        $markdownedProductDTO->setPrice(
            $this->taxService->calculateSumWithTax($markdownedProductDTO->getPrice(), $taxInfoDTO->tax)
        );

        $markdownedProductDTO->setPrice(
            $this->couponService->calculateResultAfterSale($coupon, $markdownedProductDTO->getPrice())
        );

        return $markdownedProductDTO;
    }

    public function makePurchase(MarkdownedProductDTO $markdownedProductDTO, string $paymentType = 'paypal'): void
    {
        switch ($paymentType) {
            case 'paypal':
                (new \Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor)->pay((int)$markdownedProductDTO->getPrice());
                break;
            case 'stripe':
                $isSuccess = (new \Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor)->processPayment((int)$markdownedProductDTO->getPrice());
                break;
            default:
                throw new \Exception('Payment type not supported');
        }
    }
}