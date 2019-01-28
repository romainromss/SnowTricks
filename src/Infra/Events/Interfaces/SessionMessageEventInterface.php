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

interface SessionMessageEventInterface
{
  /**
   * SessionMessageEventInterface constructor.
   *
   * @param string $flashBag
   * @param string $message
   */
  public function __construct(
    string $flashBag,
    string $message
  );
  
  /**
   * @return string
   */
  public function getMessage(): string;
  
  /**
   * @return string
   */
  public function getType(): string;
}
