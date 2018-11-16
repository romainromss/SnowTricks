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

use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Picture;
use App\Domain\Models\Trick;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class TrickRepository.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TrickRepository extends ServiceEntityRepository implements TrickRepositoryInterface
{
  public function __construct(RegistryInterface $registry)
  {
    parent::__construct($registry, Trick::class);
  }
  
  /**
   * @param bool $first
   *
   * @return mixed
   */
  public function getAllWithPictures(bool $first = false)
  {
    return $this->createQueryBuilder('t')
      ->innerJoin('t.picture', 'p')
      ->setParameter(':first', $first)
      ->where('p.first = :first')
      ->orderBy('t.createdAt', 'DESC')
      ->setCacheable(true)
      ->getQuery()
      ->getResult()
      ;
  }
  
  /**
   * @param $slug
   * @param $id
   *
   * @return TrickInterface
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getBySlugWithPicturesId($slug, $id): TrickInterface
  {
    return $this->createQueryBuilder('t')
      ->leftJoin('t.picture', 'p')
      ->setParameter(':slug', $slug)
      ->setParameter(':id', $id)
      ->Where('p.id = :id')
      ->andWhere('t.slug = :slug')
      ->setCacheable(true)
      ->getQuery()
      ->getOneOrNullResult()
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
      ->innerJoin('t.picture', 'p')
      ->leftJoin('t.movie', 'm')
      ->leftJoin('t.comment', 'tc')
      ->leftJoin('tc.user', 'cu')
      ->innerJoin('t.user', 'u')
      ->leftJoin('u.picture', 'up')
      ->where('t.slug = :slug')
      ->setParameter('slug', $slug)
      ->setCacheable(true)
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
    $this->_em->persist($tricks);
    $this->_em->flush();
  }
  
  /**
   *{@inheritdoc}
   */
  public function update($tricks): void
  {
    $this->_em->flush();
  }
  
  /**
   * @param string $slug
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function deleteTrick(string $slug)
  {
    $tricks = $this->getBySlug ($slug);
    $this->_em->remove($tricks);
    $this->_em->flush();
  }
}
