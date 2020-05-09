<?php

namespace App\Repository;

use App\Entity\Apod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apod|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apod|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apod[]    findAll()
 * @method Apod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apod::class);
    }

    // /**
    //  * @return Apod[] Returns an array of Apod objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Apod
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
