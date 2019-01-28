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

use App\Domain\Models\Interfaces\UsersInterface;
use App\Infra\Events\Interfaces\UserEventInerface;
use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event implements UserEventInerface
{
  const USER_REGISTER = 'user.register';
  const USER_FORGOT = 'user.forgot';
  
  /** @var UsersInterface */
  private $user;
  
  /**
   * UserEvent constructor.
   *
   * @param UsersInterface $user
   */
  public function __construct(UsersInterface $user)
  {
    $this->user = $user;
  }
  
  /**
   * @return UsersInterface
   */
  public function getUser(): UsersInterface
  {
    return $this->user;
  }
}
