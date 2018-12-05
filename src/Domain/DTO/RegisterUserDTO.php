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

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\RegisterUserDTOInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RegisterUserDTO implements RegisterUserDTOInterface
{
  /** @var string */
  public $mail;
  
  /** @var string */
  public $username;
  
  /** @var string */
  public $name;
  
  /** @var string */
  public $lastname;
  
  /** @var string */
  public $password;
  
  public $picture;
  
  /**
   * {@inheritdoc}
   */
  public function __construct(
    string $username,
    string $mail,
    string $name,
    string $lastname,
    string $password,
    $picture = null
  ) {
    $this->username = $username;
    $this->mail = $mail;
    $this->name = $name;
    $this->lastname = $lastname;
    $this->password = $password;
    $this->picture = $picture;
  }
}
