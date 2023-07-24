<?php

namespace App\Repository;

use App\Entity\Matchbox;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Matchbox>
 *
 * @method Matchbox|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matchbox|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matchbox[]    findAll()
 * @method Matchbox[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchboxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matchbox::class);
    }

//    /**
//     * @return Matchbox[] Returns an array of Matchbox objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Matchbox
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
