<?php

declare(strict_types=1);

namespace App\Tax\Domain\Entity;

use App\Shared\Domain\Service\UlidService;
/**
 * @Entity
 * @Table(name="tax_mask_taxes")
 */
class MaskTax
{
    private string $ulid;
    private string $mask;
    private string $country;
    private float $tax;

    public function __construct(string $mask, string $country, float $tax)
    {
        $this->ulid = UlidService::generate();
        $this->mask = $mask;
        $this->country = $country;
        $this->tax = $tax;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getMask(): string
    {
        return $this->mask;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getTax(): float
    {
        return $this->tax;
    }
}
