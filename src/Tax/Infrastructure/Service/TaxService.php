<?php

declare(strict_types=1);

namespace App\Tax\Infrastructure\Service;

use App\Tax\Application\DTO\TaxInfoDTO;
use App\Tax\Domain\Service\TaxServiceInterface;
use App\Tax\Infrastructure\Repository\MaskTaxRepository;

class TaxService implements TaxServiceInterface
{
    public function __construct(
        private readonly MaskTaxRepository $maskTaxRepository,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function getTaxInfo(string $taxNumber): TaxInfoDTO
    {
        $countryCode = $taxNumber[0].$taxNumber[1];

        $maskTax = $this->maskTaxRepository->findByCountryCode($countryCode);

        if (is_null($maskTax)) {
            throw new \Exception("Не найдена информация о налоге");
        }

        return TaxInfoDTO::fromEntity($maskTax);
    }

    public function calculateSumWithTax(float $price, float $tax): float
    {
        return $price + ($price * $tax / 100);
    }
}