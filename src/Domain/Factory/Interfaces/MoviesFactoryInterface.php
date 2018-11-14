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

use App\Domain\Models\Interfaces\MoviesInterface;

/**
 * Interfaces MoviesFactoryInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface MoviesFactoryInterface
{
  /**
   * @param string $embed
   * @param string $legend
   *
   * @return MoviesInterface
   */
  public function create(
    string $embed,
    string $legend
  ): MoviesInterface;
  
  /**
   * @param array $movies
   *
   * @return mixed
   */
  public function createFromArray(array $movies = []);
}
