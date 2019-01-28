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

namespace App\Tests\Domain\Factory;

use App\Domain\Factory\UserFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class UserFactoryUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UserFactoryUnitTest extends TestCase
{
  private $user;
  private $username;
  private $email;
  private $emailToken;
  private $name;
  private $lastname;
  private $password;
  private $picture;
  
  protected function setUp()
  {
    $this->user = $this->createMock(UserFactory::class);
    $this->username = 'username';
    $this->email = 'email';
    $this->emailToken = 'emailToken';
    $this->name = 'name';
    $this->lastname = 'lastname';
    $this->password = 'password';
    $this->picture = '';
  }
  
  public function testInstanceOf()
  {
    $userFactory = new UserFactory();
    static::assertInstanceOf(UserFactory::class, $userFactory);
  }
  
  public function testcreate()
  {
    $user = new UserFactory();
    $user->create(
      $this->username,
      $this->email,
      $this->emailToken,
      $this->name,
      $this->lastname,
      $this->password,
      $this->picture
    );
    
    static::assertInstanceOf(UserFactory::class, $user);
  }
}
