<?php

namespace App\Repository;

use App\Entity\Association;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Association>
 */
class AssociationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Association::class);
    }

    public function findTotalCountOfAssociation() {

        return $this->createQueryBuilder('a')
                ->select("COUNT(a.id) as total")
                ->getQuery()
                ->getSingleResult()
        ;
    }
    
    public function findTotalCountInRegion(int $regionId) {

        return $this->createQueryBuilder('a')
                    ->select('COUNT(a.id) as total')
                    ->join('a.commune', 'c')
                    ->join('c.district', 'd')
                    ->join('d.region', 'r')
                    ->where('r.id = :regionId')
                    ->setParameter('regionId', $regionId)
                    ->getQuery()
                    ->getResult()
        ;
    }

    public function findTotalCountInDistrict(int $districtId) {

        return $this->createQueryBuilder('a')
                ->select('COUNT(a.id) as total')
                ->join('a.commune', 'c')
                ->join('c.district', 'd')
                ->where('d.id = :districtId')
                ->setParameter('districtId', $districtId)
                ->getQuery()
                ->getResult()
        ;
    }

//    /**
//     * @return Association[] Returns an array of Association objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Association
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}