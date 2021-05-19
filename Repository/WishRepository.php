<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function findAllByDate(){
//En DQL
        $entityManager = $this->getEntityManager();
        $dql = "SELECT w
                FROM App\Entity\Wish as w
                ORDER BY w.dateCreated DESC";

        $query = $entityManager->createQuery($dql);

        $query->setMaxResults(50);

        return $query->getResult();
    }

    public function findBestWishes(){

        //Avec le queryBuilder
        $queryBuilder = $this->createQueryBuilder('w');
        $queryBuilder->andWhere('w.note > 9')
            ->addOrderby('w.dateCreated', 'DESC');

        $query = $queryBuilder->getQuery();

        $query->setMaxResults(50);

        return $query->getResult();
    }
    // /**
    //  * @return Wish[] Returns an array of Wish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wish
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
