<?php

namespace App\Repository;

use App\Entity\Gallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Gallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gallery[]    findAll()
 * @method Gallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gallery::class);
    }

    public function findGalleryByPage($page = 0, $limit = 100)
    {
        $entityManager = $this->getEntityManager();
        $dql = <<<DQL
SELECT g
FROM App\Entity\Gallery g
DQL;
        $query = $entityManager
                ->createQuery($dql)
                ->setFirstResult($page * $limit)
                ->setMaxResults($limit);

        $paginator = new Paginator($query, true);

        return $paginator;
    }


    public function findGalleryByUserByPage($user, $page = 0, $limit = 100)
    {
        $entityManager = $this->getEntityManager();
        $dql = <<<DQL
SELECT g
FROM App\Entity\Gallery g
WHERE g.user = :user
DQL;
        $query = $entityManager
                ->createQuery($dql)
                ->setParameter(':user', $user)
                ->setFirstResult($page * $limit)
                ->setMaxResults($limit);

        $paginator = new Paginator($query, true);

        return $paginator;
    }

    // /**
    //  * @return Gallery[] Returns an array of Gallery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gallery
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
