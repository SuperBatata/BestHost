<?php

namespace App\Repository;

use App\Entity\MaisonHote;
use App\Entity\MaisonRecherche;
use App\Entity\PriceSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Migrations\Query\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method MaisonHote|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaisonHote|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaisonHote[]    findAll()
 * @method MaisonHote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaisonHoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaisonHote::class);
    }

   
    // /**
    //  * @return MaisonHote[] Returns an array of MaisonHote objects
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
    public function findOneBySomeField($value): ?MaisonHote
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
