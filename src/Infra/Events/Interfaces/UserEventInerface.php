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

namespace App\Infra\Events\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;

interface UserEventInerface
{
  /**
   * UserEvent constructor.
   *
   * @param UsersInterface $user
   */
  public function __construct(UsersInterface $user);
  
  /**
   * @return UsersInterface
   */
  public function getUser(): UsersInterface;
}