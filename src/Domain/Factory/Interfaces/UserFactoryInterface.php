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

namespace App\Domain\Factory\Interfaces;

use App\Domain\DTO\PictureDTO;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\Picture;

/**
 * Interface UserFactoryInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface UserFactoryInterface
{
  /**
   * @param string      $username
   * @param string      $email
   *
   * @param string      $emailToken
   * @param string      $name
   * @param string      $lastname
   * @param string      $password
   * @param             $picture
   *
   * @return UserInterface
   */
  public function create(
    string $username,
    string $email,
    string $emailToken,
    string $name,
    string $lastname,
    string $password,
    $picture
  ): UserInterface;
}
