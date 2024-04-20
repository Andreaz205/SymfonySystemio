<?php

declare(strict_types=1);

namespace App\Products\Application\DTO;

use App\Products\Domain\Entity\Product;

class MarkdownedProductDTO
{

    public function __construct(
        private string $name,
        private float $price
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public static function fromEntity(Product $product): self
    {
        return new self($product->getName(), $product->getPrice());
    }

    public function toArray(): array
    {
        return [
            'product' => $this->name,
            'price' => $this->price,
        ];
    }
}