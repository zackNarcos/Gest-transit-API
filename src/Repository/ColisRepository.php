<?php

namespace App\Repository;

use App\Entity\Colis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Colis>
 *
 * @method Colis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Colis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Colis[]    findAll()
 * @method Colis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Colis::class);
    }

    public function add(Colis $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Colis $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Colis[] Returns an array of Colis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function countByUser($value, $label, $year, $month): ?int
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT SUM('.$label.') FROM `colis`
                 WHERE YEAR(date_depot) = :year 
                 AND MONTH(date_depot) = :month 
                 AND employe_id = :id';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'id' => $value,
            'year' => $year,
            'month' => $month,
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchOne();
    }

    public function countColisByUser($value, $label, $year, $month): ?int
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT('.$label.') FROM `colis`
                 WHERE YEAR(date_depot) = :year 
                 AND MONTH(date_depot) = :month 
                 AND employe_id = :id';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'id' => $value,
            'year' => $year,
            'month' => $month,
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchOne();
    }

    /**
    //     * @return Colis[] Returns an array of Pays objects
    //     */
    public function findColisByDestination($value, $year, $month, $day): ?array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM `colis`
                 WHERE YEAR(date_depot) = :year 
                 AND MONTH(date_depot) = :month 
                 AND DAY(date_depot) = :day 
                 AND pays_destination_id = :id
                 ORDER BY id DESC';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'id' => $value,
            'year' => $year,
            'month' => $month,
            'day' => $day,
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }

    public function findColisIn($value, $year, $month): ?array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM `colis`
                 WHERE YEAR(date_depot) = :year 
                 AND MONTH(date_depot) = :month 
                 AND pays_destination_id = :id
                 ORDER BY id DESC';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'id' => $value,
            'year' => $year,
            'month' => $month,
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }

    /**
    //     * @return Colis[] Returns an array of Pays objects
    //     */
    public function findColisByUser($value, $year, $month, $day): ?array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM `colis`
                 WHERE YEAR(date_depot) = :year 
                 AND MONTH(date_depot) = :month 
                 AND DAY(date_depot) = :day 
                 AND employe_id = :id
                 ORDER BY id DESC';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'id' => $value,
            'year' => $year,
            'month' => $month,
            'day' => $day,
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }

    public function somColisByDay()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT SUM(prix_total) FROM `colis` WHERE YEAR(date_depot) = YEAR(NOW()) AND MONTH(date_depot) = MONTH(NOW()) AND DAY(date_depot) = DAY(NOW())';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchOne();
    }

    public function countColisByDay()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT COUNT(id) FROM `colis` WHERE YEAR(date_depot) = YEAR(NOW()) AND MONTH(date_depot) = MONTH(NOW()) AND DAY(date_depot) = DAY(NOW())';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchOne();
    }

    public function somReelColisByDay()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT SUM(avance) FROM `colis` WHERE YEAR(date_depot) = YEAR(NOW()) AND MONTH(date_depot) = MONTH(NOW()) AND DAY(date_depot) = DAY(NOW())';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchOne();
    }

    public function SomComByYear(int $mois)
    {
        $conn = $this->getEntityManager()->getConnection();

//        SELECT COUNT(id) FROM `commande` WHERE YEAR(date) = YEAR(NOW()) AND MONTH(date) = :mois AND etat = "VALIDER"
        $sql = 'SELECT SUM(prix_total) FROM `colis` WHERE YEAR(date_depot) = YEAR(NOW()) AND MONTH(date_depot) = :mois';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['mois' => $mois]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchOne();
    }

    public function getUserStatByYear()
    {
        $conn = $this->getEntityManager()->getConnection();

//        SELECT COUNT(id) FROM `commande` WHERE YEAR(date) = YEAR(NOW()) AND MONTH(date) = :mois AND etat = "VALIDER"
        $sql = 'SELECT SUM(c.prix_total) as prix_total, SUM(c.avance) as avance, u.nom, u.prenom, u.ville FROM `colis` c INNER JOIN user u ON u.id = c.employe_id WHERE YEAR(c.date_depot)=YEAR(NOW()) GROUP BY u.nom,u.prenom,u.ville';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAll();
    }
}
