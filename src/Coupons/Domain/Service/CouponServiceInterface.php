<?php

declare(strict_types=1);

namespace App\Coupons\Domain\Service;

use App\Coupons\Domain\Entity\Coupon;

interface CouponServiceInterface
{
    public function calculateResultAfterSale(Coupon $coupon, float $price): float;
}