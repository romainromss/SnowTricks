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

use App\Domain\Factory\PictureFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class PictureFactoryUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PictureFactoryUnitTest extends TestCase
{
  /**
   * @var string
   */
  private $name;
  
  /**
   * @var string
   */
  private $legend;
  
  /**
   * @var bool
   */
  private $first;
  
  /**
   * @var PictureFactory
   */
  private $picture;
  
  protected function setUp()
  {
    $this->picture = $this->createMock(PictureFactory::class);
    
    $this->name = 'name';
    $this->legend = 'legend';
    $this->first = false;
  }
  
  public function testInstanceOf()
  {
    $pictureFactory = new PictureFactory();
    static::assertInstanceOf(PictureFactory::class, $pictureFactory);
  }
  
  public function testcreate()
  {
    $picture = new PictureFactory();
    $picture->create(
      $this->name,
      $this->legend,
      $this->first = false
  );
    
    static::assertInstanceOf(PictureFactory::class, $picture);
  }
}
