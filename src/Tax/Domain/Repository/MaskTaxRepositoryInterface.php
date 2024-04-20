<?php

declare(strict_types=1);

namespace App\Tax\Domain\Repository;

use App\Tax\Domain\Entity\MaskTax;

interface MaskTaxRepositoryInterface
{
    public function findByCountryCode(string $code): ?MaskTax;

    public function add(MaskTax $maskTax): void;
}
