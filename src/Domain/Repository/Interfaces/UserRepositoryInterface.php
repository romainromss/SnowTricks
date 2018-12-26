<?php

declare(strict_types = 1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Repository\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;

interface UserRepositoryInterface
{
  /**
   * @param string $username
   *
   * @return UsersInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByUsername(string $username):? UsersInterface;
  
  /**
   * @param string $email
   *
   * @return UsersInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByEmail(string $email):? UsersInterface;
  
  /**
   * @param string $username
   * @param string $email
   *
   * @return UsersInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByUsernameAndEmail(string $username, string $email);
  
  /**
   * @param string $token
   *
   * @return UsersInterface|null
   */
  public function getUserByToken(string $token): ? UsersInterface;
  
  /**
   * @param string $token
   *
   * @return mixed
   */
  public function getUserByPasswordToken(string $token);
  
  /**
   * @param $user
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function save($user);
 
  /**
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function flush();
  
  public function loadUserByUsername($username);
}
