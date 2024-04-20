<?php

declare(strict_types=1);

namespace App\Tax\Infrastructure\Repository;

use App\Tax\Domain\Entity\MaskTax;
use App\Tax\Domain\Repository\MaskTaxRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MaskTaxRepository extends ServiceEntityRepository implements MaskTaxRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaskTax::class);
    }

    public function add(MaskTax $maskTax): void
    {
        $manager = $this->getEntityManager();

        $manager->persist($maskTax);
        $manager->flush();
    }

    public function findByCountryCode(string $code): ?MaskTax
    {
         $result =  $this->getEntityManager()
            ->getRepository(MaskTax::class)
            ->createQueryBuilder('mt')
            ->where("mt.mask LIKE :code")
            ->setParameter('code', '%'.$code.'%')
             ->setMaxResults(1)
            ->getQuery()
            ->getResult();

         if (count($result) && !empty($result[0])) {
             return $result[0];
         }

         return null;
    }
}
