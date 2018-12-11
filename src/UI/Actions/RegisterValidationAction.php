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

use App\Domain\Repository\UserRepository;
use App\Infra\Events\SessionMessageEvent;
use App\UI\Responder\ResponderRegisterValidation;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterValidationAction
{
  /** @var UserRepository */
  private $userRepository;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /**
   * RegisterValidationAction constructor.
   *
   * @param UserRepository           $userRepository
   * @param EventDispatcherInterface $eventDispatcher
   */
  public function __construct(
    UserRepository $userRepository,
    EventDispatcherInterface $eventDispatcher
  ) {
    $this->userRepository = $userRepository;
    $this->eventDispatcher = $eventDispatcher;
  }
  
  /**
   * @Route("/register-validation/{token}", name="register-validation")
   *
   * @param Request                     $request
   * @param ResponderRegisterValidation $responderRegisterValidation
   *
   * @return RedirectResponse
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function __invoke(
    Request $request,
    ResponderRegisterValidation $responderRegisterValidation
  ): RedirectResponse {
  
    if (!$this->userRepository->getUserByToken($request->attributes->get('token'))) {
      $this->eventDispatcher->dispatch(
        SessionMessageEvent::SESSION_MESSAGE,
        new SessionMessageEvent(
          'error',
          'error.tokenNotFound'
        )
      );
      return $responderRegisterValidation();
    }
    
    if($user = $this->userRepository->getUserByToken($request->get('token'))) {
      $user->validate();
      $this->userRepository->flush();
      $this->eventDispatcher->dispatch(SessionMessageEvent::SESSION_MESSAGE, new SessionMessageEvent('success', 'validation.success'));
    };
    return $responderRegisterValidation();
  }
}
