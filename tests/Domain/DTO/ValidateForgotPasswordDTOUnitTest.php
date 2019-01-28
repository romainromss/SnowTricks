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

use App\Domain\DTO\ValidateForgotPasswordDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class ValidateForgotPasswordDTOUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ValidateForgotPasswordDTOUnitTest extends TestCase
{
  public function testConstruct()
  {
    $password = 'password';
  
    $validateForgotPasswordDTO =  new ValidateForgotPasswordDTO($password);
    static::assertInstanceOf(ValidateForgotPasswordDTO::class, $validateForgotPasswordDTO);
  }
}