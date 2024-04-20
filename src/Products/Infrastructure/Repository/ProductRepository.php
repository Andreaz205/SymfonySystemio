<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Repository;

use App\Products\Domain\Repository\ProductRepositoryInterface;
use App\Products\Domain\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $product): void
    {
        $manager = $this->getEntityManager();

        $manager->persist($product);
        $manager->flush();
    }
    public function findByName(string $name): ?Product
    {
        return $this->findOneBy(['name' => $name]);
    }
}
