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

use App\UI\Responder\ResponderValidateForgotPassword;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ResponderValidateForgotPasswordUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderValidateForgotPasswordUnitTest extends TestCase
{
  /** @var Environment */
  private $twig;
  
  /** @var  */
  private $forgotPasswordType;
  
  private $urlGenerator;
  
  protected function setUp()
  {
    $this->twig = $this->createMock(Environment::class);
    $this->forgotPasswordType = $this->createMock(FormInterface::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->urlGenerator->method('generate')->willReturn('/');
  }
  
  public function testConstruct()
  {
    $responder = new ResponderValidateForgotPassword($this->twig, $this->urlGenerator);
    static::assertInstanceOf(ResponderValidateForgotPassword::class, $responder);
  }
  
  /**
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testRender()
  {
    $responder = new ResponderValidateForgotPassword($this->twig, $this->urlGenerator);
    static::assertInstanceOf(Response::class, $responder(['form' => $this->forgotPasswordType]));
  }
}