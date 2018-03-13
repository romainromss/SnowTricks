<?php

namespace App\Repository;

use App\Entity\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Tricks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tricks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tricks[]    findAll()
 * @method Tricks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TricksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tricks::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('t')
            ->where('t.something = :value')->setParameter('value', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /**
     * @param int $page
     * @param int $maxByPage
     * @return mixed
     */
    public function getAllWithPictures($page = 1, $maxByPage = 9): Paginator
    {
        $query = $this->createQueryBuilder('t')
            ->leftJoin('t.pictures', 'p')
            ->addSelect('p')
            ->orderBy('t.created_at', 'DESC')
            ->setFirstResult(($page - 1) * $maxByPage)
            ->setMaxResults($maxByPage)
             ;
        $page = new Paginator($query);
        return $page;

    }
}
