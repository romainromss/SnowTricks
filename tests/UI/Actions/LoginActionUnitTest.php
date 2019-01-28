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

namespace App\Tests\UI\Actions;


use App\UI\Actions\LoginAction;
use App\UI\Responder\LoginResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

/**
 * Class LoginActionUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class LoginActionUnitTest extends TestCase
{
  /** @var FormFactoryInterface */
  private $formFactory;
  
  /** @var Request */
  private $request;
  
  /** @var Environment */
  private $twig;
  
  /** @var AuthenticationUtils */
  private $authentificationUtils;
  
  /** @var FormInterface */
  private $formInterface;
  
  protected function setUp()
  {
    $this->formFactory = $this->createMock(FormFactoryInterface::class);
    $this->twig = $this->createMock(Environment::class);
    $this->authentificationUtils = $this->createMock(AuthenticationUtils::class);
    $this->formInterface = $this->createMock(FormInterface::class);
    $this->request = $this->createMock(Request::class);
  
    $this->authentificationUtils->method('getLastUsername')->willReturn('test');
    $this->formFactory->method('create')->willReturn($this->formInterface);
  }
  
  public function testConstruct()
  {
    $constructAction = new LoginAction($this->formFactory);
    static::assertInstanceOf(LoginAction::class, $constructAction);
  }
  
  public function testReturnResponderLogin()
  {
    $constructAction = new LoginAction($this->formFactory);
    $responder = new LoginResponder($this->twig);
    
    static::assertInstanceOf(Response::class, $constructAction(
      $this->request,
      $this->authentificationUtils,
      $responder
    ));
  }
}