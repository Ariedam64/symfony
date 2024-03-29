<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */

    public function findByEntreprise($entreprise)
    {
        return $this->createQueryBuilder('stages')
            ->join('stages.entreprises','entreprise')
            ->andWhere('entreprise.nom = :nomEntreprise')
            ->setParameter('nomEntreprise', $entreprise)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFormation($formation)
    {
      return $this->getEntityManager()
                  ->createQuery(
                    'SELECT stage, formations
                    FROM App\Entity\Stage stage
                    JOIN stage.Formation formations
                    WHERE formations.nom = :nom')
                    ->setParameter('nom', $formation)
                    ->execute();
    }

    public function allStage(){

      return $this->getEntityManager()
                  ->createQuery(
                    'SELECT stage, entreprises
                    FROM App\Entity\Stage stage
                    JOIN stage.entreprises entreprises')
                    ->execute();
    }





    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
