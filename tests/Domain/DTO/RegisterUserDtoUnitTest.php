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

use App\Domain\DTO\RegisterUserDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class RegisterUserDtoUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class RegisterUserDtoUnitTest extends TestCase
{
 
  public function testConstruct()
  {
    $username = 'username';
    $mail = 'mail';
    $name = 'name';
    $lastname = 'lastname';
    $password = 'password';
    $picture = '';
    
    $registerDTO =  new RegisterUserDTO($username, $mail, $name, $lastname, $password, $picture);
    static::assertInstanceOf(RegisterUserDTO::class, $registerDTO);
  }
}
