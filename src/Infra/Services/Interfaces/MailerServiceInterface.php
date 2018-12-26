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

namespace App\Infra\Services\Interfaces;

interface MailerServiceInterface
{
  /**
   * @param string $subject
   * @param string $mail
   * @param string $name
   * @param string $token
   * @param string $template
   *
   * @return mixed
   */
  public function sendMail(
    string $subject,
    string $mail,
    string $name,
    string $token,
    string $template
    );
}
