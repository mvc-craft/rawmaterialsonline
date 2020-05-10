<?php

namespace App\Repository;

use App\Entity\RawClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RawClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method RawClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method RawClass[]    findAll()
 * @method RawClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RawClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RawClass::class);
    }

    // /**
    //  * @return RawClass[] Returns an array of RawClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RawClass
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
