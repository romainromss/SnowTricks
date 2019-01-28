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

namespace App\Infra\Events;

use App\Infra\Events\Interfaces\SessionMessageEventInterface;
use Symfony\Component\EventDispatcher\Event;

class SessionMessageEvent extends Event implements SessionMessageEventInterface
{
  const SESSION_MESSAGE = 'session_message';
  
  /** @var string */
  private $flashBag;
  
  /** @var string */
  private $message;
  
  public function __construct(
    string $flashBag,
    string $message
  ) {
    $this->flashBag = $flashBag;
    $this->message = $message;
  }
  
  /**
   * @return string
   */
  public function getMessage(): string
  {
    return $this->message;
  }
  
  /**
   * @return string
   */
  public function getType(): string
  {
    return $this->flashBag;
  }
}
