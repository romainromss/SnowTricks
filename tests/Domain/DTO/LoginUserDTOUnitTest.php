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

namespace App\Tests\Domain\DTO;

use App\Domain\DTO\LoginUserDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class LoginUserDTOUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class LoginUserDTOUnitTest extends TestCase
{
  public function testConstruct()
  {
    $username = 'username';
    $password = 'password';
  
    $loginUserDTO =  new LoginUserDTO($username, $password);
    static::assertInstanceOf(LoginUserDTO::class, $loginUserDTO);
  }
}