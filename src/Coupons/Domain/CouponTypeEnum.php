<?php

declare(strict_types=1);

namespace App\Coupons\Domain;

enum CouponTypeEnum: string
{
    case FIXED = "F";
    case PERCENT = "P";
}
