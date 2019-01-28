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

use App\UI\Responder\LoginResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class LoginResponderUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class LoginResponderUnitTest extends TestCase
{
  /**
   * @var Environment
   */
  private $twig;
  
  private $loginType;
  
  protected function setUp()
  {
    $this->twig = $this->createMock(Environment::class);
    $this->loginType = $this->createMock(FormInterface::class);
  
  }
  
  public function testConstruct()
  {
    $responder = new LoginResponder($this->twig);
    static::assertInstanceOf(LoginResponder::class, $responder);
  }
  
  public function testRender()
  {
    $responder = new LoginResponder($this->twig);
    static::assertInstanceOf(Response::class, $responder(['form' => $this->loginType]));
  }
}