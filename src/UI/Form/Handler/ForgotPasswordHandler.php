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

use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Infra\Events\UserEvent;
use App\Infra\Services\GeneratorTokenService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

/**
 * Class ForgotPasswordHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ForgotPasswordHandler
{
  /** @var UserRepositoryInterface */
  private $userRepository;
  
  /** @var Environment */
  private $twig;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /**
   * ForgotPasswordTypeHandler constructor.
   *
   * @param UserRepositoryInterface $userRepository
   * @param Environment             $twig
   * @param EventDispatcherInterface         $eventDispatcher
   */
  public function __construct(
    UserRepositoryInterface $userRepository,
    Environment $twig,
    EventDispatcherInterface $eventDispatcher
  ) {
    $this->userRepository = $userRepository;
    $this->twig = $twig;
    $this->eventDispatcher = $eventDispatcher;
  }
  
  /**
   * @param FormInterface $form
   *
   * @return bool
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function handle(FormInterface $form)
  {
    if ($form->isSubmitted() && $form->isValid()) {
      $user = $this->userRepository->getUserByUsernameAndEmail(
        $form->getData()->username,
        $form->getData()->mail
      );
      $user->passwordToken(GeneratorTokenService::generateToken());
      $this->eventDispatcher->dispatch(UserEvent::USER_FORGOT, new UserEvent($user));
      $this->userRepository->flush();
      return true;
    }
    return false;
  }
}
