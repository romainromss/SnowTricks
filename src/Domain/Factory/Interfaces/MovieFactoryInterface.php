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

namespace App\Domain\Factory\Interfaces;

use App\Domain\Models\Interfaces\MovieInterface;

/**
 * Interfaces MovieFactoryInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface MovieFactoryInterface
{
  /**
   * @param string $embed
   * @param string $legend
   *
   * @return MovieInterface
   */
  public function create(
    string $embed,
    string $legend
  ): MovieInterface;
  
  /**
   * @param array $movie
   *
   * @return mixed
   */
  public function createFromArray(array $movie = []);
}
