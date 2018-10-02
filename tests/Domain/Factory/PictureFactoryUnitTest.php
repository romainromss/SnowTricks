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

use App\Domain\DTO\PictureDTO;
use App\Domain\Factory\PictureFactory;
use App\Infra\Helper\UploaderHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

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
    $pictureFactory = new PictureFactory($this->createMock(UploaderHelper::class));
    static::assertInstanceOf(PictureFactory::class, $pictureFactory);
  }
  
  public function testcreate()
  {
    $picture = new PictureFactory($this->createMock(UploaderHelper::class));
    $picture->create(
      $this->name,
      $this->legend,
      $this->first = false
    );
    
    static::assertInstanceOf(PictureFactory::class, $picture);
  }
  
  /**
   * @throws \Exception
   */
  public function testCreateFromArray()
  {
    $file = '360.svg';
  
    $uploaderHelperMock= $this->createMock(UploaderHelper::class);
    $splFileInfoMock = $this->createMock(\SplFileInfo::class);
    
    $splFileInfoMock->method('getFilename')->willReturn($file);
    $uploaderHelperMock->method('upload')->willReturn($file);
    
    $pictureDTO = new PictureDTO($splFileInfoMock, $this->legend, $this->first);
    $pictureFactory = new PictureFactory($uploaderHelperMock);
    
    $values =  $pictureFactory->createFromArray([$pictureDTO]);
    
    static::assertNotNull($values);
  }
  
  /**
   * @throws \Exception
   */
  public function testCreateFromEmptyArray()
  {
    $uploaderHelperMock= $this->createMock(UploaderHelper::class);
  
    $uploaderHelperMock->method('upload')->willReturn('');
    $pictureFactory = new PictureFactory($uploaderHelperMock);
  
    $values =  $pictureFactory->createFromArray([]);
    static::assertNull($values);
  }
}
