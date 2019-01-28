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

  use App\Domain\DTO\PictureDTO;
  use PHPUnit\Framework\TestCase;
  use Symfony\Component\HttpFoundation\File\UploadedFile;

  /**
   * Class PictureDTOUnitTest.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class PictureDTOUnitTest extends TestCase
  {
    /**
     * PictureDTOUnitTest constructor.
     */
    public function testConstruct ()
    {
      $legend = 'legend';
      $first = false;
      
      $pictureDTO = new PictureDTO($this->createMock(UploadedFile::class), $legend, $first);
      static::assertInstanceOf (PictureDTO::class, $pictureDTO);
    }
  }
  