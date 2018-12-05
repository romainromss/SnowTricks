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

namespace App\Domain\Services;

use App\Domain\Services\Interfaces\GeneratorTokenServiceInterface;

class GeneratorTokenService implements GeneratorTokenServiceInterface
{
  public static function generateToken()
  {
    return md5(uniqid());
  }
}
