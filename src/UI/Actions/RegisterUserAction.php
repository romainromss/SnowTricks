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

namespace App\UI\Actions;

use App\Infra\Events\SessionMessageEvent;
use App\UI\Form\Handler\RegisterUserHandler;
use App\UI\Form\Type\RegisterUserType;
use App\UI\Responder\ResponderRegisterUser;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegisterUserAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class RegisterUserAction
{
  /**
   * @var FormFactoryInterface
   */
  private $formFactory;
  
  /**
   * @var RegisterUserHandler
   */
  private $registerUserHandler;
  
  /**
   * @var EventDispatcherInterface
   */
  private $eventDispatcher;
  
  /**
   * RegisterUserAction constructor.
   *
   * @param FormFactoryInterface $formFactory
   * @param RegisterUserHandler  $registerUserHandler
   * @param EventDispatcherInterface        $eventDispatcher
   */
  public function __construct(
    FormFactoryInterface $formFactory,
    RegisterUserHandler $registerUserHandler,
    EventDispatcherInterface $eventDispatcher
  ) {
    $this->formFactory = $formFactory;
    $this->registerUserHandler = $registerUserHandler;
    $this->eventDispatcher = $eventDispatcher;
  }
  
  /**
   * @Route("/register", name="Register")
   *
   * @param Request               $request
   * @param ResponderRegisterUser $responderRegisterUser
   *
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function __invoke(
    Request $request,
    ResponderRegisterUser $responderRegisterUser
  ) {
    $registerUserType = $this->formFactory
      ->create(RegisterUserType::class)
      ->handleRequest($request);
    
    if ($this->registerUserHandler->handle($registerUserType)) {
     $this->eventDispatcher->dispatch(SessionMessageEvent::SESSION_MESSAGE, new SessionMessageEvent('success', 'vous pouvez vous connecter'));
      return $responderRegisterUser(true);
    }
    
    return $responderRegisterUser(false,[
      'form' => $registerUserType->createView()
    ],  $registerUserType);
  }
}
