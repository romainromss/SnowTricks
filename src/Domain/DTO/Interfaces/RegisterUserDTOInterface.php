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

namespace App\Domain\DTO\Interfaces;

use App\Domain\Models\Interfaces\PictureInterface;

interface RegisterUserInterface
{
  /**
   * RegisterUserDTO constructor.
   *
   * @param string|null $mail
   * @param string|null $username
   * @param string|null $name
   * @param string|null $lastname
   * @param string|null $password
   */
  public function __construct(
    string $mail = null,
    string $username = null,
    string $name = null,
    string $lastname = null,
    string $password = null,
    string $role = null,
    PictureInterface $picture
  );
}