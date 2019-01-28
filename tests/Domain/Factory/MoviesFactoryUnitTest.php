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

use App\Domain\DTO\MovieDTO;
use App\Domain\Factory\MovieFactory;
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
   * @var MovieFactory
   */
  private $movies;
  
  protected function setUp()
  {
    $this->movies = $this->createMock(MovieFactory::class);
    
    $this->embed = 'embed';
    $this->legend = 'legend';
  }
  
  public function testInstanceOf()
  {
    $moviesFactory = new MovieFactory();
    static::assertInstanceOf(MovieFactory::class, $moviesFactory);
  }
  
  public function testcreate()
  {
    $movies = new MovieFactory();
    $movies->create(
      $this->embed,
      $this->legend
    );
    
    static::assertInstanceOf(MovieFactory::class, $movies);
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
    $movie[] = new MovieDTO($embed, $legend);
    
    $movies = new MovieFactory();
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
    $movies = new MovieFactory();
    $values =  $movies->createFromArray();
    
    static::assertNull($values);
  }
}
