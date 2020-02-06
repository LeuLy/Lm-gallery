<?php

namespace App\Repository;

use App\Entity\ComicStrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ComicStrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComicStrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComicStrip[]    findAll()
 * @method ComicStrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComicStripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComicStrip::class);
    }

    // /**
    //  * @return ComicStrip[] Returns an array of ComicStrip objects
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
    public function findOneBySomeField($value): ?ComicStrip
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
