<?php

namespace App\Repository;

use App\Entity\Family;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Family|null find($id, $lockMode = null, $lockVersion = null)
 * @method Family|null findOneBy(array $criteria, array $orderBy = null)
 * @method Family[]    findAll()
 * @method Family[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilyRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * FamilyRepository constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $manager
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Family::class);
        $this->manager = $manager;
    }

    /**
     * @param $familyName
     */
    public function saveFamily($familyName)
    {
        $newFamily = new Family();
        $newFamily->setName($familyName);
        $this->manager->persist($newFamily);
        $this->manager->flush();
    }

    /**
     * @param Family $family
     * @return Family
     */
    public function updateFamily(Family $family)
    {
        $this->manager->persist($family);
        $this->manager->flush();
        return $family;
    }

    /**
     * @param Family $family
     * @return Family
     */
    public function removeFamily(Family $family)
    {
        $this->manager->remove($family);
        $this->manager->flush();
        return $family;
    }

    // /**
    //  * @return Family[] Returns an array of Family objects
    //  */
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
    public function findOneBySomeField($value): ?Family
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
