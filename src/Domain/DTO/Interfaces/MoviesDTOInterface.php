<?php

declare(strict_types = 1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\DTO\Interfaces;

/**
 * Interfaces MoviesDTOInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface MoviesDTOInterface
{
  /**
   * MoviesDTOInterface constructor.
   *
   * @param string|null $embed
   * @param string|null $legend
   */
  public function __construct(
    string $embed = null,
    string $legend = null
  );
}
