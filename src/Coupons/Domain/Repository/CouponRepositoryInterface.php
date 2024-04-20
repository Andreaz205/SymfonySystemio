<?php

declare(strict_types=1);

namespace App\Coupons\Domain\Repository;

use App\Coupons\Domain\Entity\Coupon;

interface CouponRepositoryInterface
{
    public function findByCode(string $name): ?Coupon;
}
