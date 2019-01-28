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
use App\Infra\Events\SessionMessageEvent;
use App\Infra\Events\UserEvent;
use App\Infra\Services\GeneratorTokenService;
use App\UI\Form\Handler\Interfaces\ForgotPasswordTypeHandlerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ForgotPasswordHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ForgotPasswordHandler implements ForgotPasswordTypeHandlerInterface
{
  /** @var UserRepositoryInterface */
  private $userRepository;
  
  /** @var Environment */
  private $twig;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  /**
   * ForgotPasswordTypeHandler constructor.
   *
   * @param UserRepositoryInterface  $userRepository
   * @param Environment              $twig
   * @param EventDispatcherInterface $eventDispatcher
   * @param UrlGeneratorInterface    $urlGenerator
   */
  public function __construct(
    UserRepositoryInterface $userRepository,
    Environment $twig,
    EventDispatcherInterface $eventDispatcher,
    UrlGeneratorInterface $urlGenerator
  ) {
    $this->userRepository = $userRepository;
    $this->twig = $twig;
    $this->eventDispatcher = $eventDispatcher;
    $this->urlGenerator = $urlGenerator;
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
    if($form->isSubmitted() && $form->isValid()) {
      $user = $this->userRepository->getUserByUsernameAndEmail(
        $form->getData()->username,
        $form->getData()->mail
      );
      if($user) {
        $user->passwordToken(GeneratorTokenService::generateToken());
        $this->eventDispatcher->dispatch(UserEvent::USER_FORGOT, new UserEvent($user));
        $this->userRepository->flush();
        return true;
      }
      $this->eventDispatcher->dispatch(
        SessionMessageEvent::SESSION_MESSAGE,
        new SessionMessageEvent('error', 'mauvais pseudo ou email'));
    }
    return false;
  }
}
