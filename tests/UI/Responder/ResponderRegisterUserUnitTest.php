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

use App\UI\Form\Type\RegisterUserType;
use App\UI\Responder\ResponderRegisterUser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ResponderRegisterUserUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderRegisterUserUnitTest extends TestCase
{
  /** @var Environment */
  private $twig;
  
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  /** @var RegisterUserType */
  private $registerUserType;
  
  protected function setUp()
  {
    $this->twig = $this->createMock(Environment::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->registerUserType = $this->createMock(FormInterface::class);
  }
  
  public function testInstanceOf()
  {
    $responder = $this->createMock(ResponderRegisterUser::class);
    static::assertInstanceOf(ResponderRegisterUser::class, $responder);
  }
  
  /**
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testConstruct()
  {
    $responder = new ResponderRegisterUser($this->twig, $this->urlGenerator);
    static::assertInstanceOf(Response::class, $responder(false, ['form'],$this->registerUserType));
  }
}
