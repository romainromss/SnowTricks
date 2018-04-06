<?php
declare(strict_types=1);

namespace App\Repository;

use App\Domain\Models\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class TricksRepository
 *
 * @package App\Repository
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
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
