<?php

namespace App\Repository;

use App\Entity\ServicesDirections;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ServicesDirections>
 */
class ServicesDirectionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicesDirections::class);
    }

    public function findDirectionById(int $id) {
        return $this->createQueryBuilder("sd")
            ->select("s.id as service, d.id as direction")
            ->join("sd.directions", "d")
            ->join("sd.services", "s")
            ->where("sd.id = :id")
            ->setParameter("id", $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    //    /**
    //     * @return ServicesDirections[] Returns an array of ServicesDirections objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ServicesDirections
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
