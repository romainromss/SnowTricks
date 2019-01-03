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

namespace App\UI\Form\Handler;

use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Infra\Events\SessionMessageEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

/**
 * Class ValidateForgotPasswordHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ValidateForgotPasswordHandler
{
  /**
   * @var UserRepositoryInterface
   */
  private $userRepository;
  
  /**
   * @var EncoderFactoryInterface
   */
  private $encoderFactory;
  
  /**
   * @var EventDispatcherInterface
   */
  private $eventDispatcher;
  
  /**
   * ValidateForgotPasswordHandler constructor.
   *
   * @param UserRepositoryInterface $userRepository
   * @param EncoderFactoryInterface $encoderFactory
   * @param EventDispatcherInterface         $eventDispatcher
   */
  public function __construct(
    UserRepositoryInterface $userRepository,
    EncoderFactoryInterface $encoderFactory,
    EventDispatcherInterface $eventDispatcher
  ) {
    $this->userRepository = $userRepository;
    $this->encoderFactory = $encoderFactory;
    $this->eventDispatcher = $eventDispatcher;
  }
  
  /**
   * @param FormInterface  $form
   * @param UsersInterface $user
   *
   * @return bool
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function handle(FormInterface $form, UsersInterface $user)
  {
    if ($form->isSubmitted() && $form->isValid()) {
      $encoder = $this->encoderFactory->getEncoder(User::class);
      $user->passwordReset($encoder->encodePassword($form->getData()->password, ''));
      $this->eventDispatcher->dispatch(SessionMessageEvent::SESSION_MESSAGE,
        new SessionMessageEvent('success', 'le mot de passe a été réinitialisé'));
      $this->userRepository->flush();
      return true;
    }
    return false;
  }
}
