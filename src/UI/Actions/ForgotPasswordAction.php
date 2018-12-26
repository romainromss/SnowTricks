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

namespace App\UI\Actions;

use App\Infra\Events\SessionMessageEvent;
use App\UI\Form\Handler\ForgotPasswordHandler;
use App\UI\Form\Type\ForgotPasswordType;
use App\UI\Responder\ResponderForgotPassword;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ForgotPasswordAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ForgotPasswordAction
{
  /** @var FormFactoryInterface */
  private $formFactory;
  
  /** @var ForgotPasswordHandler */
  private $forgotPasswordHandler;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /**
   * ForgotPasswordAction constructor.
   *
   * @param FormFactoryInterface     $formFactory
   * @param ForgotPasswordHandler    $forgotPasswordHandler
   * @param EventDispatcherInterface $eventDispatcher
   */
  public function __construct(
    FormFactoryInterface $formFactory,
    ForgotPasswordHandler $forgotPasswordHandler,
    EventDispatcherInterface $eventDispatcher
  ) {
    $this->formFactory = $formFactory;
    $this->forgotPasswordHandler = $forgotPasswordHandler;
    $this->eventDispatcher = $eventDispatcher;
  }
  
  /**
   * @Route("/forgot", name="forgot")
   *
   * @param Request                 $request
   * @param ResponderForgotPassword $responderForgotPassword
   *
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function __invoke(
    Request $request,
    ResponderForgotPassword $responderForgotPassword
  ) {
    $forgotPasswordType = $this->formFactory
      ->create(ForgotPasswordType::class)
      ->handleRequest($request);
    
    if ($this->forgotPasswordHandler->handle($forgotPasswordType)) {
      $this->eventDispatcher->dispatch(SessionMessageEvent::SESSION_MESSAGE, new SessionMessageEvent('success', 'un mail de réinitialisation a été envoyé'));
      return $responderForgotPassword(true);
    }
    
    return $responderForgotPassword(false,[
      'form' => $forgotPasswordType->createView()
    ],  $forgotPasswordType);
  }
}
