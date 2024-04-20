<?php

declare(strict_types=1);

namespace App\Products\Domain\Service;

use App\Products\Application\DTO\MarkdownedProductDTO;

interface ProductServiceInterface
{
    public function makePurchase(MarkdownedProductDTO $markdownedProductDTO, string $paymentType = 'paypal'): void;

    public function getMarkdownedProduct(
        string $productName,
        string $couponCode,
        string $taxNumber,
    ): MarkdownedProductDTO;
}