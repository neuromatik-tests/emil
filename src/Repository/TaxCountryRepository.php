<?php

namespace App\Repository;

use App\Entity\TaxCountry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaxCountry>
 *
 * @method TaxCountry|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaxCountry|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaxCountry[]    findAll()
 * @method TaxCountry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxCountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxCountry::class);
    }

    //    /**
    //     * @return TaxCountry[] Returns an array of TaxCountry objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TaxCountry
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
