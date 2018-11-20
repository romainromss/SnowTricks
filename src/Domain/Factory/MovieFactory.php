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

namespace App\Domain\Factory;

use App\Domain\Factory\Interfaces\MovieFactoryInterface;
use App\Domain\Models\Interfaces\MovieInterface;
use App\Domain\Models\Movie;

/**
 * Class MovieFactory.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MovieFactory implements MovieFactoryInterface
{
  /**
   *{@inheritdoc}
   *
   * @throws \Exception
   */
  public function create(
    string $embed,
    string $legend
  ): MovieInterface {
    return new Movie($embed, $legend);
  }
  
  /**
   * @param array $movies
   *
   * @return array|mixed|void
   *
   * @throws \Exception
   */
  public function createFromArray(array $movies = [])
  {
    if (\count($movies) == 0) {
      return;
    }
    
    $entries = [];
    foreach ($movies as $movie) {
      $entries[] = new Movie($movie->embed, $movie->legend);
    }
    return $entries;
  }
}
