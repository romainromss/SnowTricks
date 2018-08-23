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
    public function getPicturesFirst(bool $first = false)
    {
      return $this->createQueryBuilder('p')
       ->where('p.first = :first')
       ->setParameter('first', $first)
       ->getQuery()
       ->getResult()
       ;
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getPictureByTrickSlugAndFirst($slug)
    {
      return $this->createQueryBuilder('p')
       ->leftJoin('p.trick', 't')
       ->setParameter(':slug', $slug)
       ->where('t.slug = :slug')
       ->getQuery()
       ->getResult ()
       ;
    }

    /**
     * @param $id
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getPicturesById($id)
    {
      return $this->createQueryBuilder('p')
       ->where('p.id = :id')
       ->setParameter(':id', $id)
       ->getQuery()
       ->getOneOrNullResult()
       ;
    }
  
    /**
     * @param string $id
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function deletePictures(string $id)
    {
      $picture = $this->getPicturesById ($id);

      $this->_em->remove($picture);
      $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function flush()
    {
      $this->_em->flush();
    }
  }
