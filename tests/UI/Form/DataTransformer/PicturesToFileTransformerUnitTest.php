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

namespace App\Tests\UI\Form\DataTransformer;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\DTO\PictureDTO;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Pictures;
use App\Infra\Helper\Interfaces\UploaderHelperInterface;
use App\Infra\Helper\UploaderHelper;
use App\UI\Form\DataTransformer\Interfaces\PicturesToFileTransformerInterface;
use App\UI\Form\DataTransformer\PicturesToFIleTransformer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class PicturesToFileTransformerTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
final class PicturesToFileTransformerUnitTest extends TestCase
{
  /**
   * @var PicturesToFileTransformerInterface
   */
  private $transformer = null;
  
  /**
   * @var UploaderHelper
   */
  private $uploader = null;
  
  protected function setUp()
  {
    $this->uploader = $this->createMock(UploaderHelper::class);
    
    $this->transformer = new PicturesToFIleTransformer(__DIR__.'/../../../assets/', $this->uploader);
  }
  
  
  public function testItImplements()
  {
    static::assertInstanceOf(PicturesToFileTransformerInterface::class, $this->transformer);
    static::assertInstanceOf(DataTransformerInterface::class, $this->transformer);
  }
  
  public function testItDoesNotTransform()
  {
    
    static::assertNull($this->transformer->transform('test'));
  }
  
  public function testItTransformDTOWithoutPicture()
  {
    $dto = $this->createMock(UpdateTrickDTO::class);
    
    static::assertInstanceOf(UpdateTrickDTOInterface::class, $this->transformer->transform($dto));
  }
  
  public function testItTransformDTOWithPicture()
  {
    $pictureMock = $this->createMock(PicturesInterface::class);
    $pictureMock->method('getName')->willReturn('360.svg');
    
    $dto = new UpdateTrickDTO('', '', '', [$pictureMock]);
    $result = $this->transformer->transform($dto);
    
    static::assertInstanceOf(UpdateTrickDTOInterface::class, $result);
    static::assertInstanceOf(\SplFileInfo::class, $result->pictures[0]);
  }
  
  public function testItDoesNotReverseTransformWithoutPicture()
  {
    $dto = new UpdateTrickDTO('', '', '', []);
    
    static::assertInstanceOf(UpdateTrickDTOInterface::class, $this->transformer->reverseTransform($dto));
  }
  
  public function testItDoesNotReverseTransformWithPicture()
  {
    $fileMock = $this->createMock(\SplFileInfo::class);
    
    $this->uploader->method('upload')->willReturn('350.svg');
    
    $picture = new PictureDTO($fileMock, '', false);
    $dto = new UpdateTrickDTO('', '', '', [$picture]);
    $result = $this->transformer->reverseTransform($dto);
  
    static::assertInstanceOf(UpdateTrickDTOInterface::class, $result);
    static::assertInstanceOf(PicturesInterface::class, $result->pictures[0]);
  }
}
