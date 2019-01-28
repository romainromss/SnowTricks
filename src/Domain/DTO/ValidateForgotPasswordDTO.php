<?php

declare(strict_types = 1);

/*
 * This file is part of the snowtricka project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\DTO;

/**
 * Class ValidateForgotPasswordDTO.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ValidateForgotPasswordDTO
{
  /**
   * @var string
   */
  public $password;
  
  /**
   * ValidateForgotPasswordDTO constructor.
   *
   * @param string $password
   */
  public function __construct(string $password)
  {
    $this->password = $password;
  }
}