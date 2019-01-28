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

namespace App\Tests\UI\Responder;

use App\UI\Responder\ResponderRegisterValidation;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ResponderRegisterValidationUnitTest extends TestCase
{
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  protected function setUp()
  {
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->urlGenerator->method('generate')->willReturn('/'); 
  }
  
  public function testInstanceOf()
  {
    $responder = $this->createMock( ResponderRegisterValidation::class);
    static::assertInstanceOf( ResponderRegisterValidation::class, $responder);
  }
  
  public function testConstruct()
  {
    $responder = new ResponderRegisterValidation($this->urlGenerator);
    static::assertInstanceOf(Response::class, $responder());
  }
}