<?php

namespace App\Repository;

use App\Entity\Employes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employes>
 */
class EmployesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employes::class);
    }

    public function findEmployeByMatricule(string $matricule) {
        return $this->createQueryBuilder("emp")
            ->select("emp.id, emp.imatriculation, emp.nom, emp.prenom, emp.email, f.id as fonctionId, sd.id as serviceId")
            ->join("emp.servicesdirections", "sd")
            ->join("emp.fonction", "f")
            ->where("emp.imatriculation = :matricule")
            ->setParameter("matricule", $matricule)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    //    /**
    //     * @return Employes[] Returns an array of Employes objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Employes
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
