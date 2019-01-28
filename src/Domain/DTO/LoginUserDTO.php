<?php

declare(strict_types = 1);

/*
 * This file is part of the snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\LoginUserDTOInterface;

/**
 * Class LoginUserDTO.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class LoginUserDTO implements LoginUserDTOInterface
{
  /** @var string */
  public $username;
  
  /** @var string */
  public $password;
  
  public function __construct(
    string $username,
    string $password
  ) {
    $this->username = $username;
    $this->password = $password;
  }
}
