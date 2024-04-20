<?php

declare(strict_types=1);

namespace App\Coupons\Infrastructure\Repository;

use App\Coupons\Domain\Repository\CouponRepositoryInterface;
use App\Coupons\Domain\Entity\Coupon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CouponRepository extends ServiceEntityRepository implements CouponRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    public function add(Coupon $coupon): void
    {
        $manager = $this->getEntityManager();

        $manager->persist($coupon);
        $manager->flush();
    }
    public function findByCode(string $name): ?Coupon
    {
        return $this->findOneBy(['name' => $name]);
    }
}
