<?php

declare(strict_types=1);

namespace App\Products\Domain\Factory;

use App\Products\Domain\Entity\Product;

class ProductFactory
{
    public function create(string $name, float $price): Product
    {
        return new Product($name, $price);
    }
}
