<?php

namespace App\Repository;

use App\Entity\UserTbl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserTbl>
 *
 * @method UserTbl|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTbl|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTbl[]    findAll()
 * @method UserTbl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTblRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserTbl::class);
    }

//    /**
//     * @return UserTbl[] Returns an array of UserTbl objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserTbl
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
