<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Console;

use App\Products\Domain\Repository\ProductRepositoryInterface;
use App\Products\Domain\Factory\ProductFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

#[AsCommand(
    name: 'app:products:create-product',
    description: 'create product',
)]
class CreateProduct extends Command
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductFactory $productFactory,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $io->ask(
            'name',
            null,
            function (?string $input) {
                Assert::notEmpty($input, 'Name must not be empty');
                Assert::string($input, 'Name is invalid');

                return $input;
            }
        );

        $taxNumber = $io->askHidden(
            'tax_number',
            function (?string $input) {
                Assert::notEmpty($input, 'Tax number invalid');
                Assert::string($input, 'Tax number must not be empty');

                return $input;
            }
        );

        $product = $this->productFactory->create($name, $taxNumber);
        $this->productRepository->add($product);

        return Command::SUCCESS;
    }
}
