<?php

namespace App\Repository;

use App\Entity\TypeCasier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeCasier|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCasier|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCasier[]    findAll()
 * @method TypeCasier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCasierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeCasier::class);
    }
    public function findTypeCasiers()
    {
        return $this->createQueryBuilder('tc')
            ->orderBy('tc.nom', 'ASC');
      // return $this->findByType(null, array('id'=>'ASC'));
    }
    // /**
    //  * @return TypeCasier[] Returns an array of TypeCasier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeCasier
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
