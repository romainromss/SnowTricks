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

namespace App\Domain\DTO\Interfaces;

/**
 * Interface ForgotPasswordDTOInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface ForgotPasswordDTOInterface
{
  /**
   * ForgotPasswordDTO constructor.
   *
   * @param string|null $username
   * @param string|null $mail
   */
  public function __construct(
    string $username = null,
    string $mail = null
  );
}