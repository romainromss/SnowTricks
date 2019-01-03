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

use App\UI\Actions\ForgotPasswordAction;
use App\UI\Form\Handler\ForgotPasswordHandler;
use App\UI\Responder\ResponderForgotPassword;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ForgotPasswordActionUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ForgotPasswordActionUnitTest extends TestCase
{
  /** @var FormFactoryInterface */
  private $formFactory;
  
  /** @var  ForgotPasswordHandler*/
  private $forgotPasswordHandler;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcherInterface;
  
  /** @var Environment */
  private $twig;
  
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  /** @var Request */
  private $request;
  
  protected  function setUp()
  {
    $this->formFactory = $this->createMock(FormFactoryInterface::class);
    $this->forgotPasswordHandler = $this->createMock(ForgotPasswordHandler::class);
    $this->eventDispatcherInterface = $this->createMock(EventDispatcherInterface::class);
    $this->twig = $this->createMock(Environment::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $formInterface = $this->createMock(FormInterface::class);
    
    $this->request = Request::create('/forgot', 'GET');
    $formInterface->method('handleRequest')->willReturnSelf();
    $this->formFactory->method('create')->willReturn($formInterface);
    $this->urlGenerator->method('generate')->willReturn('/');
  }
  
  public function testConstruct()
  {
    $action = new ForgotPasswordAction(
      $this->formFactory,
      $this->forgotPasswordHandler,
      $this->eventDispatcherInterface,
      $this->urlGenerator
    );
    static::assertInstanceOf(ForgotPasswordAction::class, $action);
  }
  
  /**
   * @return ResponderForgotPassword
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testReturnFalse()
  {
    $action = new ForgotPasswordAction(
      $this->formFactory,
      $this->forgotPasswordHandler,
      $this->eventDispatcherInterface,
      $this->urlGenerator
    );
    $responder = new ResponderForgotPassword(
      $this->twig,
      $this->urlGenerator
    );
    $this->forgotPasswordHandler->method('handle')->willReturn(false);
    static::assertInstanceOf(Response::class, $action(
      $this->request,
      $responder
    ));
    return $responder;
  }
  
  /**
   * @return ResponderForgotPassword
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testReturnTrue()
  {
    $action = new ForgotPasswordAction(
      $this->formFactory,
      $this->forgotPasswordHandler,
      $this->eventDispatcherInterface,
      $this->urlGenerator
    );
    $responder = new ResponderForgotPassword(
      $this->twig,
      $this->urlGenerator
    );
    $this->forgotPasswordHandler->method('handle')->willReturn(true);
    static::assertInstanceOf(Response::class, $action(
      $this->request,
      $responder
    ));
    return $responder(true);
  }
}