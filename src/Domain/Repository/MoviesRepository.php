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

use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Movies;
use App\Domain\Repository\Interfaces\MoviesRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class MoviesRepository.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MoviesRepository extends ServiceEntityRepository implements MoviesRepositoryInterface
{
    /**
     * MoviesRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movies::class);
    }

  /**
   * {@inheritdoc}
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getMoviesByEmbed($id)
  {
    return $this->createQueryBuilder('m')
     ->where('m.id = :id')
     ->setParameter(':id', $id)
     ->getQuery()
     ->getOneOrNullResult()
     ;
  }

  /**
   *{@inheritdoc}
   */
  public function deleteMovies(MoviesInterface $movies)
  {
    $this->_em->remove($movies);
    $this->_em->flush();
  }
}
