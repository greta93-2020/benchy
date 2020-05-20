<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Carbon\Carbon;
use App\Entity\Casiers;
use App\Entity\TypeCasier;

/**
 * @method Casiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Casiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Casiers[]    findAll()
 * @method Casiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CasiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Casiers::class);
    }

    public function findProdCasiers()
    {
        $em = $this->getEntityManager();
        return $this->createQueryBuilder('c')
            ->andWhere('c.type = :type')
            ->andWhere('c.tag = 1')
            ->setParameter('type', $em->getRepository(TypeCasier::class)->find(3))
            ->orderBy('c.id', 'ASC');
      // return $this->findByType(null, array('id'=>'ASC'));
    }
    public function findRedacCasiers()
    {
        $em = $this->getEntityManager();
        return $this->createQueryBuilder('c')
            ->andWhere('c.type = :type')
            ->andWhere('c.tag = 1')
            ->setParameter('type', $em->getRepository(TypeCasier::class)->find(1))
            ->orderBy('c.id', 'ASC');
      // return $this->findByType(1, array('id'=>'ASC'));
    }
   /**
    * @return Casiers[] Returns an array of Casiers objects
    */
/*
    public function getUpcomingCasiersDates()
    {
      $query = $this->createQueryBuilder('m');
        return $query
            ->select('DISTINCT(m.date) as date')
            ->andWhere('DATE(m.date) >= :val')
            ->setParameter('val', date('Y-m-d'))
            ->orderBy('m.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function getCasierssByDateUser($date, $user)
    {
      $query = $this->createQueryBuilder('m');
      if (!$user instanceof User) {
          $user = $this->getEntityManager()->getRepository(User::class)->find($user);
      }
        $username = $user->getGenre() == "homme" ? "Mr ".$user->getNom() : "Ms ".$user->getNom();
        return $query
            ->Where("m.date = :date")
            ->andWhere("m.user = :user OR m.tcName = :username OR m.contactClient = :username")
            ->setParameter('date', $date)
            ->setParameter('user', $user)
            ->setParameter('username', $username)
            ->orderBy('m.heure', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getDatesByClient($client)
    {
      $query = $this->createQueryBuilder('m');
        return $query
            ->select('CONCAT(MONTH(m.date), YEAR(m.date)) as date')
            ->andWhere('m.client >= :val')
            ->setParameter('val', $client)
            ->orderBy('m.date', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getDatesByUser($user)
    {
      $query = $this->createQueryBuilder('m');
        return $query
            ->select('CONCAT(MONTH(m.date), YEAR(m.date)) as date')
            ->andWhere('m.user >= :val')
            ->setParameter('val', $user)
            ->orderBy('m.date', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function getCasierssForClientDates($clientSelected, $startMonth, $endMonth)
    {
      $query = $this->createQueryBuilder('m');
        return $query
            ->where('m.date BETWEEN :startMonth AND :endMonth')
            ->andWhere("m.client = :client")
            ->setParameter('client', $clientSelected)
            ->setParameter('startMonth', $startMonth)
            ->setParameter('endMonth', $endMonth)
            ->orderBy('m.tour', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function getCasierssForUserDates($userSelected, $startMonth, $endMonth)
    {
      $query = $this->createQueryBuilder('m');
        return $query
            ->where('m.date BETWEEN :startMonth AND :endMonth')
            ->andWhere("m.user = :user")
            ->setParameter('user', $userSelected)
            ->setParameter('startMonth', $startMonth)
            ->setParameter('endMonth', $endMonth)
            ->orderBy('m.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findLastCodeCasiers()
    {
      $query = $this->createQueryBuilder('m');
      $temp = null;
      try {
          $temp = $query
              ->select('m.codeCasiers')
              ->orderBy('m.id', 'desc')
              ->setMaxResults(1)
              ->getQuery()
              ->getSingleScalarResult()
          ;
      } catch (\Exception $e) {
          $temp = "MIS20000";
      }
        if ($temp) {
            return $temp;
        }
        else {
            return "MIS20000";
        }
    }
*/
//    /**
//     * @return Casiers[] Returns an array of Casiers objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Casiers
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
