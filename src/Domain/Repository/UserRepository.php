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

use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UserRepository.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
  private $picture;
  
  /**
   * UserRepository constructor.
   *
   * @param RegistryInterface $registry
   */
  public function __construct(RegistryInterface $registry)
  {
    parent::__construct($registry, User::class);
  }
  
  /**
   * {@inheritdoc}
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByUsername(string $username):? UserInterface
  {
    return $this->createQueryBuilder('user')
      ->where('user.username = :username')
      ->setParameter('username', $username)
      ->setCacheable(true)
      ->getQuery()
      ->getOneOrNullResult();
  }
  
  /**
   * {@inheritdoc}
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByEmail(string $mail):? UserInterface
  {
    return $this->createQueryBuilder('user')
      ->where('user.email = :email')
      ->setParameter('email', $mail)
      ->setCacheable(true)
      ->getQuery()
      ->getOneOrNullResult();
  }
  
  /**
   * {@inheritdoc}
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByUsernameAndEmail(string $username, string $mail)
  {
    return $this->createQueryBuilder('user')
      ->where('user.username = :username AND user.email = :email')
      ->setParameter('username', $username)
      ->setParameter('email', $mail)
      ->getQuery()
      ->getOneOrNullResult();
  }
  
  /**
   * @param string $token
   *
   * @return UserInterface|null
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByToken(string $token): ? UserInterface
  {
    return $this->createQueryBuilder('user')
      ->where('user.emailToken = :token')
      ->setParameter('token', $token)
      ->getQuery()
      ->getOneOrNullResult();
  }
  
  /**
   * {@inheritdoc}
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function save($user)
  {
    $this->getEntityManager()->persist($user);
    $this->getEntityManager()->flush();
  }
  
  /**
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function flush()
  {
    $this->getEntityManager()->flush();
  }
}
