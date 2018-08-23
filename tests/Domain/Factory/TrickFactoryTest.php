<?php

declare(strict_types=1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Domain\Factory;

use App\Domain\Factory\TrickFactory;
use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Tricks;
use PHPUnit\Framework\TestCase;

/**
 * Class TrickBuilderTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TrickFactoryTest extends TestCase
{
  /**
   * @var string
   */
  private $name;
  
  /**
   * @var string
   */
  private $description;
  
  /**
   * @var string
   */
  private $category;
  
  /**
   * @var string
   */
  
  private $users;
  
  /**
   * @var
   */
  private $pictures;
  
  /**
   * @var
   */
  private $movies;
  
  private $trick;
  
  protected function setUp()
  {
    $this->trick = $this->createMock(TrickFactory::class);
    
    $this->name = 'name';
    $this->description = 'description';
    $this->category = 'group';
    $this->users = $this->createMock(UsersInterface::class);
    $this->pictures = ['picture'];
    $this->movies = ['movies'];
  }
  
  public function testInstanceOf()
  {
    $trickFactory = new TrickFactory();
    static::assertInstanceOf(TrickFactory::class, $trickFactory);
  }
  
  public function testcreate()
  {
    $tricks = new TrickFactory();
    $tricks->create(
      $this->name,
      $this->description,
      $this->category,
      $this->users,
      $this->pictures,
      $this->movies
    );
    
    static::assertInstanceOf(TrickFactory::class, $tricks);
  }
}
