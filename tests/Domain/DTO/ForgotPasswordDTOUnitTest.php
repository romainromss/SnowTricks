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

use App\Domain\DTO\ForgotPasswordDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class ForgotPasswordDTOUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ForgotPasswordDTOUnitTest extends TestCase
{
  public function testConstruct()
  {
    $username = 'username';
    $mail = 'mail';
  
    $forgotPasswordDTO =  new ForgotPasswordDTO($username, $mail);
    static::assertInstanceOf(ForgotPasswordDTO::class, $forgotPasswordDTO);
  }
}