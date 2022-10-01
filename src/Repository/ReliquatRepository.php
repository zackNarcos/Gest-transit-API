<?php

namespace App\Repository;

use App\Entity\Reliquat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reliquat>
 *
 * @method Reliquat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reliquat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reliquat[]    findAll()
 * @method Reliquat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReliquatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reliquat::class);
    }

    public function add(Reliquat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reliquat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function countByUser($value, $label, $year, $month): ?int
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT SUM('.$label.') FROM `reliquat`
                 WHERE YEAR(date) = :year 
                 AND MONTH(date) = :month
                 AND employe_id = :id';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'year' => $year,
            'month' => $month,
            'id' => $value,
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchOne();

    }

//    /**
//     * @return Reliquat[] Returns an array of Reliquat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reliquat
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
