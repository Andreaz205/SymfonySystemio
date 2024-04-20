<?php

declare(strict_types=1);

namespace App\Products\Domain\Repository;

use App\Products\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function findByName(string $name): ?Product;
}
