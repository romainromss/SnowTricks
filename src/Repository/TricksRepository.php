<?php

namespace App\Repository;


use App\Domain\Models\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TricksRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tricks::class);
    }

    /**
     * @return mixed
     */
    public function getAllWithPictures()
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.pictures', 'p')
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }


}
