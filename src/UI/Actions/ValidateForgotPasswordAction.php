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

use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Infra\Events\SessionMessageEvent;
use App\UI\Form\Handler\ValidateForgotPasswordHandler;

use App\UI\Form\Type\ValidateForgotPasswordType;
use App\UI\Responder\ResponderValidateForgotPassword;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ValidateForgotPasswordAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ValidateForgotPasswordAction
{
  /** @var EventDispatcherInterface  */
  private $eventDispatcher;
  
  /** @var FormFactoryInterface  */
  private $formFactory;
  
  /** @var ValidateForgotPasswordHandler */
  private $validateForgotPasswordHandler;
  
  /** @var UserRepositoryInterface  */
  private $userRepository;
  
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  public function __construct(
    EventDispatcherInterface $eventDispatcher,
    FormFactoryInterface $formFactory,
    ValidateForgotPasswordHandler $validateForgotPasswordHandler,
    UserRepositoryInterface $userRepository,
    UrlGeneratorInterface $urlGenerator
  ) {
    $this->eventDispatcher = $eventDispatcher;
    $this->formFactory = $formFactory;
    $this->validateForgotPasswordHandler = $validateForgotPasswordHandler;
    $this->userRepository = $userRepository;
    $this->urlGenerator = $urlGenerator;
  }
  
  /**
   * @Route("/forgot/password/{token}", name = "validate_forgot_password")
   *
   * @param ResponderValidateForgotPassword $responderValidateForgotPassword
   * @param Request                         $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function __invoke(
    ResponderValidateForgotPassword $responderValidateForgotPassword,
    Request $request
  ) {
    $user = null;
    if (!$user = $this->userRepository->getUserByPasswordToken($request->attributes->get('token'))) {
      $this->eventDispatcher->dispatch(
        SessionMessageEvent::SESSION_MESSAGE,
        new SessionMessageEvent(
          'error',
          'error.tokenNotFound'
        )
      );
    }
      $validateForgotPasswordType = $this->formFactory
        ->create(ValidateForgotPasswordType::class)
        ->handleRequest($request);
      if ($this->validateForgotPasswordHandler->handle($validateForgotPasswordType, $user)){
        return $responderValidateForgotPassword(true);
      }
  
      return $responderValidateForgotPassword(false,[
        'form' => $validateForgotPasswordType->createView()
      ], $validateForgotPasswordType);
    }
}
