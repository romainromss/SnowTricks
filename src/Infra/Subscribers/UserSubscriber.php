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

use App\Domain\Services\Interfaces\MailerServiceInterface;
use App\Infra\Events\UserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{
  /**
   * @var MailerServiceInterface
   */
  private $mailerService;
  
  public static function getSubscribedEvents()
  {
    return [
      UserEvent::USER_REGISTER => 'userRegister'
    ];
  }
  
  public function __construct(MailerServiceInterface $mailerService)
  {
    $this->mailerService = $mailerService;
  }
  
  public function userRegister(UserEvent $event)
  {
   $this->mailerService->sendMail('Bienvenue sur snowtricks', $event->getUser()->getEmail(), $event->getUser()->getEmailToken(), $event->getUser()->getName());
  }
}
