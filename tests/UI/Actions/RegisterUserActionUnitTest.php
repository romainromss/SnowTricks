<?php

declare(strict_types = 1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Actions;

use App\UI\Actions\RegisterUserAction;
use App\UI\Form\Handler\RegisterUserHandler;
use App\UI\Responder\ResponderRegisterUser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class RegisterUserActionUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class RegisterUserActionUnitTest extends TestCase
{
  /** @var FormFactoryInterface */
  private $formFactory;
  
  /** @var RegisterUserHandler */
  private $registerUserHandler;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /** @var Environment */
  private $twig;
  
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  /** @var Request */
  private $request;
  
  protected function setUp()
  {
    $this->formFactory = $this->createMock(FormFactoryInterface::class);
    $this->registerUserHandler = $this->createMock(RegisterUserHandler::class);
    $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
    $this->twig = $this->createMock(Environment::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $formInterface = $this->createMock(FormInterface::class);
    
    $this->request = Request::create('/register', 'GET');
    $formInterface->method('handleRequest')->willReturnSelf();
    $this->formFactory->method('create')->willReturn($formInterface);
    $this->urlGenerator->method('generate')->willReturn('/');
  }
  
  public function testConstruct()
  {
    $constructResponder = new RegisterUserAction(
      $this->formFactory,
      $this->registerUserHandler,
      $this->eventDispatcher
    );
    
    static::assertInstanceOf(RegisterUserAction::class, $constructResponder);
  }
  
  /**
   * @return ResponderRegisterUser
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testReturnFalse()
  {
    $registerUserAction = new RegisterUserAction(
      $this->formFactory,
      $this->registerUserHandler,
      $this->eventDispatcher
    );
    $responder = new ResponderRegisterUser(
      $this->twig,
      $this->urlGenerator
    );
    
    $this->registerUserHandler->method('handle')->willReturn(false);
    
    static::assertInstanceOf(Response::class, $registerUserAction(
      $this->request,
      $responder
    ));
    return $responder;
  }
  
  /**
   * @return Response
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testReturnTrue()
  {
    $registerUserAction = new RegisterUserAction(
      $this->formFactory,
      $this->registerUserHandler,
      $this->eventDispatcher
    );
    $responder = new ResponderRegisterUser(
      $this->twig,
      $this->urlGenerator
    );
    
    $this->registerUserHandler->method('handle')->willReturn(true);
    
    static::assertInstanceOf(Response::class, $registerUserAction(
      $this->request,
      $responder
    ));
    return $responder(true);
  }
}
