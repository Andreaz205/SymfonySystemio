<?php

declare(strict_types=1);

namespace App\Tax\Domain\Factory;

use App\Tax\Domain\Entity\MaskTax;

class MaskTaxFactory
{
    public function create(string $mask, string $country, float $tax): MaskTax
    {
        return new MaskTax($mask, $country, $tax);
    }
}
