<?php

declare(strict_types=1);

namespace App\Products\Domain\Entity;

use App\Shared\Domain\Service\UlidService;

class Product
{
    private string $ulid;
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->ulid = UlidService::generate();
        $this->name = $name;
        $this->price = $price;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
