<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    public function findBestSeries($page){

        //En DQL
        /*$entityManager = $this->getEntityManager();
        $dql = "SELECT s
                FROM App\Entity\Serie as s
                WHERE s.vote > 8
                AND s.popularity > 100
                ORDER BY s.popularity DESC ";

        $query = $entityManager->createQuery($dql);
        */


        //Avec le queryBuilder
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->addOrderBy('s.popularity', 'DESC');
        $queryBuilder->leftJoin('s.seasons','seasons');
        $queryBuilder->addSelect('seasons');

        $query = $queryBuilder->getQuery();

        $offset = ($page - 1) * 50;

        //la même chose pour les 2
        $query->setFirstResult($offset);
        $query->setMaxResults(50);

        $paginator = new Paginator($query);
        return $paginator;

      //  return $query->getResult();

    }

}