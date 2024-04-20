<?php

declare(strict_types=1);

namespace App\Coupons\Domain\Entity;

use App\Shared\Domain\Service\UlidService;

class Coupon
{
    private string $ulid;
    private string $type;
    private int $value;
    private string $name;

    public function __construct(string $type, int $value)
    {
        $this->ulid = UlidService::generate();
        $this->type = $type;
        $this->value = $value;
        $this->name = $type . $value;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
