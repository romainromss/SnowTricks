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

namespace App\Tests\Domain\DTO;

use App\Domain\DTO\MovieDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class MoviesDTOUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MoviesDTOUnitTest extends TestCase
{
  /**
   * PictureDTOUnitTest constructor.
   */
  public function testConstruct ()
  {
    $embed = 'embed';
    $legend = 'legend';
    
    $moviesDTO = new MovieDTO($legend, $embed);
    static::assertInstanceOf (MovieDTO::class, $moviesDTO);
  }
}