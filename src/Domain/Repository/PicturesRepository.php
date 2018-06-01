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

use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Pictures;
use App\Domain\Repository\Interfaces\PicturesRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class PicturesRepository.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PicturesRepository extends ServiceEntityRepository implements PicturesRepositoryInterface
{
    /**
     * PicturesRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pictures::class);
    }

	/**
	 *{@inheritdoc}
	 */
    public function getPicturesFirst(bool $first= false)
    {
        return $this->createQueryBuilder('p')
            ->where('p.first = :first')
			->setParameter('first', $first)
            ->getQuery()
            ->getResult()
        ;
    }

	/**
	 * {@inheritdoc}
	 *
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
    public function getPicturesByTrickId($trick)
	{
		return $this->createQueryBuilder('p')
			->where('p.trick = :trick')
			->setParameter('trick', $trick )
			->getQuery()
			->getOneOrNullResult();
	}

	/**
	 *{@inheritdoc}
	 */
	public function deletePictures(PicturesInterface $pictures)
	{
		$this->_em->remove($pictures);
		$this->_em->flush();
	}
}
