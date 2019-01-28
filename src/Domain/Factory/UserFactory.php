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

namespace App\Domain\Factory;

use App\Domain\Factory\Interfaces\UserFactoryInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\User;

/**
 * Class UserFactory.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UserFactory implements UserFactoryInterface
{
  /**
   * @param string      $username
   * @param string      $email
   * @param string      $emailToken
   * @param string      $name
   * @param string      $lastname
   * @param string      $password
   *
   * @param             $picture
   *
   * @return UsersInterface
   * @throws \Exception
   */
  public function create(
    string $username,
    string $email,
    string $emailToken,
    string $name,
    string $lastname,
    string $password,
    $picture
    
  ): UsersInterface {
    return new User($username, $email, $emailToken, $name, $lastname, $password, $picture);
  }
}
