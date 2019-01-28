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

namespace App\Infra\Subscribers;

use App\Infra\Events\UserEvent;
use App\Infra\Services\GeneratorTokenService;
use App\Infra\Services\Interfaces\MailerServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;

class UserSubscriber implements EventSubscriberInterface
{
  /**
   * @var MailerServiceInterface
   */
  private $mailerService;
  /**
   * @var Environment
   */
  private $twig;
  
  public static function getSubscribedEvents()
  {
    return [
      UserEvent::USER_REGISTER => 'userRegister',
      UserEvent::USER_FORGOT => 'userForgot'
    ];
  }
  
  /**
   * UserSubscriber constructor.
   *
   * @param MailerServiceInterface $mailerService
   * @param Environment            $twig
   */
  public function __construct(
    MailerServiceInterface $mailerService,
    Environment $twig
  ) {
    $this->mailerService = $mailerService;
    $this->twig = $twig;
  }
  
  /**
   * @param UserEvent $event
   *
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function userRegister(UserEvent $event)
  {
    $this->mailerService->sendMail(
      'Bienvenue sur snowtricks',
      $event->getUser()->getEmail(),
      $event->getUser()->getName(),
      $event->getUser()->getEmailToken(),
      $this->twig->render('mail/email.html.twig', ['user' => $event->getUser()]
      ));
  }
  
  /**
   * @param UserEvent $event
   *
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function userForgot(UserEvent $event)
  {
    $this->mailerService->sendMail(
      'Reinitialiser votre mot de passe',
      $event->getUser()->getEmail(),
      $event->getUser()->getName(),
      $event->getUser()->getPasswordResetToken(),
      $this->twig->render('mail/email_reinitialisation.html.twig', ['user' => $event->getUser()]
      ));
  }
}
