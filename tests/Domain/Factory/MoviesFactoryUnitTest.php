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

namespace App\Tests\Domain\Factory;

use App\Domain\DTO\MoviesDTO;
use App\Domain\Factory\MoviesFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class MoviesFactoryTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MoviesFactoryUnitTest extends TestCase
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
  
  /**
   * @param string $embed
   * @param string $legend
   *
   * @dataProvider provideValues
   *
   * @throws \Exception
   */
  public function testCreateFromArray(string $embed, string $legend)
  {
    $movie[] = new MoviesDTO($embed, $legend);
    
    $movies = new MoviesFactory();
    $values =  $movies->createFromArray($movie);
    static::assertGreaterThan(0, \count($values));
  }
  
  /**
   * @return \Generator
   */
  public function provideValues()
  {
    yield array('toto', 'toto');
    yield array('titi', 'titi');
    yield array('tata', 'tata');
  }
  
  public function testCreateFromEmptyArray()
  {
    $movies = new MoviesFactory();
    $values =  $movies->createFromArray();
    
    static::assertNull($values);
  }
}
