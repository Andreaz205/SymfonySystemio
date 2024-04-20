<?php

declare(strict_types=1);

namespace App\Coupons\Domain\Factory;

use App\Coupons\Domain\CouponTypeEnum;
use App\Coupons\Domain\Entity\Coupon;

class CouponFactory
{
    public function create(string $type, int $value): Coupon
    {
        return new Coupon($type, $value);
    }
}
