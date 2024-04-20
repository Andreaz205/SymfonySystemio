<?php

namespace App\Shared\Application\DataFixtures;

use App\Coupons\Domain\CouponTypeEnum;
use App\Coupons\Domain\Factory\CouponFactory;
use App\Coupons\Infrastructure\Repository\CouponRepository;
use App\Products\Domain\Factory\ProductFactory;
use App\Products\Infrastructure\Repository\ProductRepository;
use App\Tax\Domain\Factory\MaskTaxFactory;
use App\Tax\Infrastructure\Repository\MaskTaxRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly ProductFactory $productFactory,
        private readonly ProductRepository $productRepository,
        private readonly CouponFactory $couponFactory,
        private readonly CouponRepository $couponRepository,
        private readonly MaskTaxFactory $maskTaxFactory,
        private readonly MaskTaxRepository $maskTaxRepository,
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
//        $faker = Factory::create();

//        $maskTaxesData = [
//            [
//                'mask' => 'DE'
//                'taxNumber' => 'DE' . $faker->numberBetween(99999999, 999999999)
//            ],
//            [
//                'taxNumber' => 'IT' . $faker->numberBetween(99999999, 999999999)
//            ],
//            [
//                'taxNumber' => 'GR' . $faker->numberBetween(99999999, 999999999)
//            ],
//            [
//                'taxNumber' => 'FR' . $faker->randomLetter() . $faker->randomLetter() . $faker->numberBetween(99999999, 999999999)
//            ],
//        ];

        $maskTaxesData = [
            [
                'mask'    => 'DEXXXXXXXXX',
                'country' => 'Германия',
                'tax'     =>  19
            ],
            [
                'mask'    => 'ITXXXXXXXXX',
                'country' => 'Италия',
                'tax'     =>  22
            ],
            [
                'mask'    => 'GRXXXXXXXXX',
                'country' => 'Греция',
                'tax'     =>  20
            ],
            [
                'mask'    => 'FRYYXXXXXXXXX',
                'country' => 'Франция',
                'tax'     =>  24
            ],
        ];

        $couponsData = [
            [
                'type' => CouponTypeEnum::PERCENT->value,
                'value' => 50
            ],
            [
                'type' => CouponTypeEnum::FIXED->value,
                'value' => 1000
            ],
        ];

        $productsData = [
            [
                'name' => 'Iphone',
                'price' => 1000,
            ],
            [
                'name' => 'Наушники',
                'price' => 2000,
            ],
            [
                'name' => 'Чехол',
                'price' => 1500,
            ],
            [
                'name' => 'Зарядник',
                'price' => 3000,
            ],
        ];

        foreach ($productsData as $productData) {
            $product = $this->productFactory->create($productData['name'], $productData['price']);

            $this->productRepository->add($product);
        }

        foreach ($couponsData as $couponData) {
            $coupon = $this->couponFactory->create($couponData['type'], $couponData['value']);

            $this->couponRepository->add($coupon);
        }

        foreach ($maskTaxesData as $maskTaxData) {
            $coupon = $this->maskTaxFactory->create(
                $maskTaxData['mask'],
                $maskTaxData['country'],
                $maskTaxData['tax'],
            );

            $this->maskTaxRepository->add($coupon);
        }
    }
}
