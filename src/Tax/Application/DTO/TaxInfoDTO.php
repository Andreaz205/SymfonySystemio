<?php

declare(strict_types=1);

namespace App\Tax\Application\DTO;

use App\Tax\Domain\Entity\MaskTax;

class TaxInfoDTO
{
    public function __construct(
        public readonly string $country,
        public readonly float $tax,
    ) {
    }

    public static function fromEntity(MaskTax $maskTax): self
    {
        return new self($maskTax->getCountry(), $maskTax->getTax());
    }
}