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

use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Repository\UserRepository;
use App\Infra\Events\SessionMessageEvent;
use App\UI\Actions\ValidateForgotPasswordAction;
use App\UI\Form\Handler\ValidateForgotPasswordHandler;
use App\UI\Responder\ResponderValidateForgotPassword;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ValidateForgotPasswordActionUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ValidateForgotPasswordActionUnitTest extends TestCase
{
  /** @var FormFactoryInterface */
  private $formFactory;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /** @var Environment */
  private $twig;
  
  /** @var ValidateForgotPasswordHandler */
  private $validateForgotPasswordHandler;
  
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  /** @var UserRepository */
  private $userRepository;
  
  /** @var Request */
  private $request;
  
  /** @var UsersInterface */
  private $user;
  
  /** @var SessionMessageEvent */
  private $sessionMessageEvent;
  
  protected function setUp()
  {
    $this->formFactory = $this->createMock(FormFactoryInterface::class);
    $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
    $this->sessionMessageEvent = $this->createMock(SessionMessageEvent::class);
    $this->validateForgotPasswordHandler = $this->createMock(ValidateForgotPasswordHandler::class);
    $this->twig = $this->createMock(Environment::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->userRepository = $this->createMock(UserRepository::class);
    $this->user = $this->createMock(UsersInterface::class);
    $formInterface = $this->createMock(FormInterface::class);
    
    $request = Request::create('/forgot/password/token', 'GET');
    $this->request = $request->duplicate(null, null, ['token' => 'token']);
    $this->userRepository->method('getUserByPasswordToken')->willReturn($this->user);
    $this->urlGenerator->method('generate')->willReturn('/');
    $formInterface->method('handleRequest')->willReturnSelf();
    $this->formFactory->method('create')->willReturn($formInterface);
  }
  
  public function testConstruct()
  {
    $action = new ValidateForgotPasswordAction(
      $this->eventDispatcher,
      $this->formFactory,
      $this->validateForgotPasswordHandler,
      $this->userRepository,
      $this->urlGenerator
    );
    static::assertInstanceOf(ValidateForgotPasswordAction::class, $action);
  }
  
  /**
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testReturnFalse()
  {
    $this->userRepository->method('getUserBytoken')->willReturn(null);
  
    $action = new ValidateForgotPasswordAction(
      $this->eventDispatcher,
      $this->formFactory,
      $this->validateForgotPasswordHandler,
      $this->userRepository,
      $this->urlGenerator
    );
    $responder = new ResponderValidateForgotPassword(
      $this->twig,
      $this->urlGenerator
    );
    $this->validateForgotPasswordHandler->method('handle')->willReturn(false);
    static::assertInstanceOf(Response::class, $action(
      $responder,
      $this->request
    ));
  }
  
  /**
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testReturnTrue()
  {
    $this->userRepository->method('getUserBytoken')->willReturn($this->user);
    
    $action = new ValidateForgotPasswordAction(
      $this->eventDispatcher,
      $this->formFactory,
      $this->validateForgotPasswordHandler,
      $this->userRepository,
      $this->urlGenerator
    );
    $responder = new ResponderValidateForgotPassword(
      $this->twig,
      $this->urlGenerator
    );
    $this->validateForgotPasswordHandler->method('handle')->willReturn(true);
    static::assertInstanceOf(Response::class, $action(
      $responder,
      $this->request
    ));
  }
}
