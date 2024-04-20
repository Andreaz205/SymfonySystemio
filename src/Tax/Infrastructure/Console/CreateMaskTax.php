<?php

declare(strict_types=1);

namespace App\Tax\Infrastructure\Console;

use App\Tax\Domain\Factory\MaskTaxFactory;
use App\Tax\Domain\Repository\MaskTaxRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

#[AsCommand(
    name: 'app:masks:create-mask-tax',
    description: 'create mask-tax',
)]
class CreateMaskTax extends Command
{
    public function __construct(
        private readonly MaskTaxRepositoryInterface $maskTaxRepository,
        private readonly MaskTaxFactory $maskTaxFactory,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $mask = $io->ask(
            'mask',
            null,
            function (?string $input) {
                Assert::notEmpty($input, 'mask must not be empty');
                Assert::string($input, 'mask is invalid');

                return $input;
            }
        );

        $country = $io->ask(
            'country',
            null,
            function (?string $input) {
                Assert::notEmpty($input, 'country must not be empty');
                Assert::string($input, 'country must be string');

                return $input;
            }
        );

        $tax = $io->ask(
            'tax',
            null,
            function (?string $input) {
                Assert::notEmpty($input, 'tax must not be empty');
                Assert::float($input, 'tax must be float');

                return $input;
            }
        );

        $mask = $this->maskTaxFactory->create($mask, $country, $tax);
        $this->maskTaxRepository->add($mask);

        return Command::SUCCESS;
    }
}
