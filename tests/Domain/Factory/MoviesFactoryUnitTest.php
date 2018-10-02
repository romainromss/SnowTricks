<?php

declare(strict_types = 1);

/*
 * This file is part of the Snowticks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Domain\Factory;

use App\Domain\Factory\MoviesFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class MoviesFactoryTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MoviesFactoryTest extends TestCase
{
  /**
   * @var string
   */
  private $embed;
  
  /**
   * @var string
   */
  private $legend;
  
  /**
   * @var MoviesFactory
   */
  private $movies;
  
  protected function setUp()
  {
    $this->movies = $this->createMock(MoviesFactory::class);
    
    $this->embed = 'embed';
    $this->legend = 'legend';
  }
  
  public function testInstanceOf()
  {
    $moviesFactory = new MoviesFactory();
    static::assertInstanceOf(MoviesFactory::class, $moviesFactory);
  }
  
  public function testcreate()
  {
    $movies = new MoviesFactory();
    $movies->create(
      $this->embed,
      $this->legend
    );
    
    static::assertInstanceOf(MoviesFactory::class, $movies);
  }
}