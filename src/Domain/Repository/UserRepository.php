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

use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * Class UserRepository.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface, UserLoaderInterface
{
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
   * @param string $username
   *
   * @return UsersInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByUsername(string $username):? UsersInterface
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
  public function getUserByEmail(string $mail):? UsersInterface
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
   * @return UsersInterface|null
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByToken(string $token): ? UsersInterface
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
  
  /**
   * @param string $username
   *
   * @return mixed|\Symfony\Component\Security\Core\User\UserInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function loadUserByUsername($username)
  {
    return $this->createQueryBuilder('user')
      ->where('user.username = :username')
      ->setParameter('username', $username)
      ->setCacheable(true)
      ->getQuery()
      ->getOneOrNullResult();
  }
}
