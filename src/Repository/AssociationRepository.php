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
                ->where("a.deletedAt IS NULL")
                ->select("COUNT(a.id) as total")
                ->getQuery()
                ->getSingleResult()
        ;
    }

    public function findAllNotDeleted() {
        return $this->createQueryBuilder('a')
                ->where("a.deletedAt IS NULL")
                ->getQuery()
                ->getResult()
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

    public function getAssociationDensity(?int $regionId = null) {
        $query = $this->createQueryBuilder('a')
                    ->select('a.nom as name, a.membre as membre')         
        ;

        if($regionId !== null) {
            $query->leftJoin("a.commune", "c")
                ->leftJoin("c.district", "d")
                ->leftJoin("d.region", "r")
                ->where("r.id = :regionId")
                ->setParameter("regionId", $regionId)
            ;
        }

        $query->orderBy('a.membre', 'DESC')
            ->setMaxResults(19)
        ;

        return $query->getQuery()->getResult();
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

    public function findTotalCountInCommune() {
        return $this->createQueryBuilder('a')
                ->select('c.nom as name, COUNT(a.id) as total')
                ->join('a.commune', 'c')
                ->groupBy('c.nom')
                ->orderBy('total', 'DESC')
                ->setMaxResults(15)
                ->getQuery()
                ->getResult()
        ;
    }

    public function getNeededOfAssociation(int $regionId = 7) {
        return $this->createQueryBuilder("a")
                ->join("a.commune", "c")
                ->join("c.district", "d")
                ->join("d.region", "r")
                ->where("r.id = :regionId")
                ->setParameter("regionId", $regionId)
                ->join("a.besoin", "b")
                ->select("b.nom_besoin as besoin, COUNT(b.id) as total")
                ->groupBy('b.nom_besoin')
                ->getQuery()
                ->getResult()
        ;
    }

    public function getPercentageOfNormalizeAssociation(?int $regionId = null) {
        $query = $this->createQueryBuilder("a")
            ->select([
                "SUM(CASE WHEN a.nom_president <> '' THEN 1 ELSE 0 END) AS nom_president",
                "SUM(CASE WHEN a.nif_stat = true THEN 1 ELSE 0 END) AS nif_stat",
                "SUM(CASE WHEN a.numero_recepisse <> '' THEN 1ELSE 0  END) AS numero_recepisse"
            ])
            ->join("a.commune", "c")
            ->join("c.district", "d")
            ->join("d.region", "r")
            ->where("a.deletedAt IS NULL")
        ;

        if($regionId !== null) {
            $query->andWhere("r.id = :regionId")
                ->setParameter("regionId", $regionId)
            ;
        }

        return $query->getQuery()->getSingleResult();
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