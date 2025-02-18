<?php

namespace App\Repository;

use App\Entity\District;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<District>
 */
class DistrictRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, District::class);
    }

    public function findDistrictWithRegionId(int $regionId) {

        return $this->createQueryBuilder('d')
                ->where('d.region = :regionId')
                ->setParameter('regionId', $regionId)
                ->getQuery()
                ->getResult()
        ;
    }

    public function findAllWithAssociations()
    {
        return $this->createQueryBuilder('d')
        ->leftJoin('d.communes', 'c')
        ->leftJoin('c.associations', 'a')
        ->getQuery()
        ->getResult();
    }

//    /**
//     * @return District[] Returns an array of District objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?District
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}