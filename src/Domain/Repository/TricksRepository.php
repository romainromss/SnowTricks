<?php

declare(strict_types=1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Repository;

use App\Domain\Models\Tricks;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class TricksRepository.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TricksRepository extends ServiceEntityRepository implements TricksRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tricks::class);
    }

    /**
     * @param bool $first
     *
     * @return mixed
     */
    public function getAllWithPictures(bool $first = false)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.pictures', 'p')
			->setParameter(':first' , $first)
            ->where('p.first = :first')
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
			->getResult()
            ;
    }


    /**
     * @param $slug
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getBySlug($slug)
    {
       return $this->createQueryBuilder('t')
            ->innerJoin('t.pictures', 'p')
            ->leftJoin('t.movies', 'm')
            ->leftJoin('t.comments', 'tc')
            ->leftJoin('tc.users', 'cu')
            ->innerJoin('t.users', 'u')
            ->leftJoin('u.pictures', 'up')
            ->where('t.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
           ;
    }

	/**
	 * @param $tricks
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function save($tricks)
	{
		$this->getEntityManager()->persist($tricks);
		$this->getEntityManager()->flush();
	}
}
