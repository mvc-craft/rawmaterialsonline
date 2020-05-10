<?php

namespace App\Repository;

use App\Entity\RawClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RawClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method RawClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method RawClass[]    findAll()
 * @method RawClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RawClassRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * RawClassRepository constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $manager
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, RawClass::class);
        $this->manager = $manager;
    }

    /**
     * @param $rawClassName
     */
    public function saveRawClass($rawClassName)
    {
        $newRawClass = new RawClass();
        $newRawClass->setName($rawClassName);
        $this->manager->persist($newRawClass);
        $this->manager->flush();
    }

    /**
     * @param RawClass $rawClass
     * @return RawClass
     */
    public function updateRawClass(RawClass $rawClass)
    {
        $this->manager->persist($rawClass);
        $this->manager->flush();
        return $rawClass;
    }

    /**
     * @param RawClass $rawClass
     * @return RawClass
     */
    public function removeRawClass(RawClass $rawClass)
    {
        $this->manager->remove($rawClass);
        $this->manager->flush();
        return $rawClass;
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
