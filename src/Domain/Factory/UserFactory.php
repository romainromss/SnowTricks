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
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\User;

/**
 * Class UserFactory.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UserFactory implements UserFactoryInterface
{
  /**
   * @param string           $username
   * @param string           $email
   * @param string           $name
   * @param string           $lastname
   * @param string           $password
   * @param string           $role
   * @param PictureInterface $picture
   * @param array            $trick
   * @param array            $comment
   *
   * @return UserInterface
   * @throws \Exception
   */
  public function create(
    string $username,
    string $email,
    string $name,
    string $lastname,
    string $password,
    string $role,
    PictureInterface $picture,
    array $trick,
    array $comment
  ): UserInterface {
    return new User($username, $email, $name, $lastname, $password, $role, $picture, $trick, $comment);
  }
}
