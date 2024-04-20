<?php

declare(strict_types=1);

namespace App\Coupons\Infrastructure\Console;

use App\Coupons\Domain\CouponTypeEnum;
use App\Coupons\Domain\Repository\CouponRepositoryInterface;
use App\Coupons\Domain\Factory\CouponFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

#[AsCommand(
    name: 'app:coupons:create-coupon',
    description: 'create coupon',
)]
class CreateCoupon extends Command
{
    public function __construct(
        private readonly CouponRepositoryInterface $couponRepository,
        private readonly CouponFactory $couponFactory,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $io->ask(
            'type',
            null,
            function (?string $input) {
                Assert::notEmpty($input, 'type must not be empty');
                Assert::string($input, 'type is invalid');
                Assert::inArray($input, [CouponTypeEnum::FIXED->value, CouponTypeEnum::PERCENT->value]);

                return $input;
            }
        );

        $taxNumber = $io->askHidden(
            'value',
            function (?string $input) {
                Assert::notEmpty($input, 'Value must not be empty');
                Assert::integer($input, 'Value must be integer');

                return $input;
            }
        );

        $coupon = $this->couponFactory->create($name, $taxNumber);
        $this->couponRepository->add($coupon);

        return Command::SUCCESS;
    }
}
