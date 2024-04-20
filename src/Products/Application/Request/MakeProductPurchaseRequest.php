<?php

declare(strict_types=1);

namespace App\Products\Application\Request;

use App\Shared\Domain\Entity\BaseRequest;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class MakeProductPurchaseRequest extends BaseRequest
{
    #[Type('string')]
    #[NotBlank()]
    protected $product;

    #[Type('string')]
    #[NotBlank()]
    protected $tax_number;

    #[Type('string')]
    #[NotBlank()]
    protected $coupon_code;

    #[Type('string')]
    protected $payment_processor;

    public function getName(): string
    {
        return $this->product;
    }

    public function getTaxNumber(): string
    {
        return $this->tax_number;
    }

    public function getCouponCode(): string
    {
        return $this->coupon_code;
    }

    public function getPaymentProcessor(): ?string
    {
        return $this->payment_processor;
    }
}