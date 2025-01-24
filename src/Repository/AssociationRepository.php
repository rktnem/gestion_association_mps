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

    public function getAssociationDensity() {
        return $this->createQueryBuilder('a')
                    ->select('a.nom as name, a.membre as membre')
                    ->orderBy('a.membre', 'DESC')
                    ->setMaxResults(19)
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

    public function getPercentageOfNormalizeAssociation() {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT
                (SELECT COUNT(nom_president) FROM association WHERE nom_president <> :empty LIMIT 1) AS nom_president,
                (SELECT COUNT(nif_stat) FROM association WHERE nif_stat = :bool LIMIT 1) AS nif_stat,
                (SELECT COUNT(numero_recepisse) FROM association WHERE numero_recepisse <> :empty LIMIT 1) AS numero_recepisse
            FROM association
        ';

        $resultSet = $conn->executeQuery($sql, [
            'empty' => '',
            'bool' => true
        ]);

        return $resultSet->fetchAssociative();
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