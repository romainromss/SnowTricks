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

use App\Domain\Models\Interfaces\UserInterface;

interface UserRepositoryInterface
{
  /**
   * @param string $username
   *
   * @return UserInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByUsername(string $username):? UserInterface;
  
  /**
   * @param string $email
   *
   * @return UserInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByEmail(string $email):? UserInterface;
  
  /**
   * @param string $username
   * @param string $email
   *
   * @return UserInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUserByUsernameAndEmail(string $username, string $email): ? UserInterface;
  
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
}
