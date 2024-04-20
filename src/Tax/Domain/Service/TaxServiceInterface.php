<?php

declare(strict_types=1);

namespace App\Tax\Domain\Service;

use App\Tax\Application\DTO\TaxInfoDTO;

interface TaxServiceInterface
{
    public function getTaxInfo(string $taxNumber): TaxInfoDTO;

    public function calculateSumWithTax(float $price, float $tax): float;
}