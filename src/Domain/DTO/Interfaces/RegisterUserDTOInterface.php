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

use App\Domain\DTO\PictureDTO;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Picture;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface RegisterUserDTOInterface
{
  /**
   * RegisterUserDTO constructor.
   *
   * @param string|null $username
   * @param string|null $mail
   * @param string|null $name
   * @param string|null $lastname
   * @param string|null $password
   * @param $picture
   */
  public function __construct(
    string $username,
    string $mail,
    string $name,
    string $lastname,
    string $password,
    $picture = null
  );
}