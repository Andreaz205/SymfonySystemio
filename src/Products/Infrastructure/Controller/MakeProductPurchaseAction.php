<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Controller;

use App\Products\Application\Request\MakeProductPurchaseRequest;
use App\Products\Domain\Service\ProductServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/products/purchase', methods: ['POST'])]
class MakeProductPurchaseAction
{
    public function __construct(
        private readonly ProductServiceInterface $productService
    )
    {
    }

    public function __invoke(MakeProductPurchaseRequest $request): JsonResponse
    {
        $violations = $request->validate();

        if ($violations->count()) {
            $errors = [];

            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }

            return new JsonResponse([
                'message' => 'Validation error',
                'errors' => $errors
            ], 422);
        }

        $markdownedProductDTO = $this->productService->getMarkdownedProduct(
            $request->getName(),
            $request->getCouponCode(),
            $request->getTaxNumber()
        );

        $this->productService->makePurchase(
            $markdownedProductDTO,
            $request->getPaymentProcessor()
        );

        return new JsonResponse([
            'message' => 'Покупка успешна',
            'data' => $markdownedProductDTO->toArray()
        ]);
    }
}
