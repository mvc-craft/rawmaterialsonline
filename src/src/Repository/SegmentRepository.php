<?php

namespace App\Repository;

use App\Entity\Segment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Segment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Segment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Segment[]    findAll()
 * @method Segment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SegmentRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * SegmentRepository constructor.
     * @param ManagerRegistry $registry
     * @param EntityManagerInterface $manager
     */
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Segment::class);
        $this->manager = $manager;
    }

    /**
     * @param $segmentName
     */
    public function saveSegment($segmentName)
    {
        $newSegment = new Segment();
        $newSegment->setName($segmentName);
        $this->manager->persist($newSegment);
        $this->manager->flush();
    }

    /**
     * @param Segment $segment
     * @return Segment
     */
    public function updateSegment(Segment $segment)
    {
        $this->manager->persist($segment);
        $this->manager->flush();
        return $segment;
    }

    /**
     * @param Segment $segment
     * @return Segment
     */
    public function removeSegment(Segment $segment)
    {
        $this->manager->remove($segment);
        $this->manager->flush();
        return $segment;
    }

    // /**
    //  * @return Segment[] Returns an array of Segment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Segment
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
