<?php

declare(strict_types=1);

namespace App\Coupons\Infrastructure\Service;

use App\Coupons\Domain\CouponTypeEnum;
use App\Coupons\Domain\Entity\Coupon;
use App\Coupons\Domain\Service\CouponServiceInterface;

class CouponService implements CouponServiceInterface
{
    /**
     * @throws \Exception
     */
    public function calculateResultAfterSale(Coupon $coupon, float $price): float
    {
        if ($coupon->getType() === CouponTypeEnum::FIXED->value) {
            return $price - $coupon->getValue();
        } elseif ($coupon->getType() === CouponTypeEnum::PERCENT->value) {
            return $price - ($price * $coupon->getValue() / 100);
        } else {
            throw new \Exception('Непредвиденный coupon type');
        }
    }
}