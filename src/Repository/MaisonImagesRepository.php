<?php

namespace App\Repository;

use App\Entity\MaisonImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaisonImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaisonImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaisonImages[]    findAll()
 * @method MaisonImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaisonImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaisonImages::class);
    }

    // /**
    //  * @return MaisonImages[] Returns an array of MaisonImages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaisonImages
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
