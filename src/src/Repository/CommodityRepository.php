<?php

namespace App\Repository;

use App\Entity\Commodity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commodity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commodity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commodity[]    findAll()
 * @method Commodity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommodityRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * CommodityRepository constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $manager
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Commodity::class);
        $this->manager = $manager;
    }

    /**
     * @param $segment
     * @param $family
     * @param $rawClass
     * @param $commodityName
     */
    public function saveCommodity($segment,$family,$rawClass,$commodityName)
    {
        $newCommodity = new Commodity();
        $newCommodity->setSegmentId($segment);
        $newCommodity->setFamilyId($family);
        $newCommodity->setRawClassId($rawClass);
        $newCommodity->setName($commodityName);
        $this->manager->persist($newCommodity);
        $this->manager->flush();
    }

    /**
     * @param Commodity $commodity
     * @return Commodity
     */
    public function updateCommodity(Commodity $commodity)
    {
        $this->manager->persist($commodity);
        $this->manager->flush();
        return $commodity;
    }

    /**
     * @param Commodity $commodity
     * @return Commodity
     */
    public function removeCommodity(Commodity $commodity)
    {
        $this->manager->remove($commodity);
        $this->manager->flush();
        return $commodity;
    }

    // /**
    //  * @return Commodity[] Returns an array of Commodity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commodity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
