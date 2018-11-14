<?php

declare(strict_types = 1);

/*
 * This file is part of the snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Form\DataTransformer;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\DTO\MoviesDTO;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Movies;
use App\UI\Form\DataTransformer\Interfaces\MoviesToFileTransformerInterface;
use App\UI\Form\DataTransformer\MoviesToFileTransformer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class MoviesToFileTransformerUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MoviesToFileTransformerUnitTest extends TestCase
{
  private $movies = null;
  
  private $transformer = null;
  
  protected function setUp()
  {
    $this->movies = $this->createMock(Movies::class);
    
    $this->transformer = new MoviesToFIleTransformer();
  }
  
  public function testItImplements()
  {
    static::assertInstanceOf(MoviesToFileTransformerInterface::class, $this->transformer);
    static::assertInstanceOf(DataTransformerInterface::class, $this->transformer);
  }
  
  public function testItDoesNotTransform()
  {
    static::assertNull($this->transformer->transform('test'));
  }
  
  public function testItTransformDTOWithoutMovies()
  {
    $dto = $this->createMock(UpdateTrickDTO::class);
    
    static::assertInstanceOf(UpdateTrickDTOInterface::class, $this->transformer->transform($dto));
  }
  
  public function testItTransformDTOWithMovies()
  {
    $movieMock = $this->createMock(MoviesInterface::class);
    $movieMock->method('getEmbed')->willReturn('rwe0rio0');
    $movieMock->method('getLegend')->willReturn('legend');
    
    $dto = new UpdateTrickDTO('', '', '', [$movieMock]);
    $result = $this->transformer->transform($dto);
    
    static::assertInstanceOf(UpdateTrickDTOInterface::class, $result);
  }
}