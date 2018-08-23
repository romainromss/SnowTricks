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

  /**
   * Class PictureDTOTest.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class PictureDTOTest extends TestCase
  {
    /**
     * PictureDTOTest constructor.
     */
    public function testConstruct ()
    {
      $legend = 'legend';
      $first = false;
      
      $pictureDTO = new PictureDTO($this->createMock(\SplFileInfo::class), $legend, $first);
      static::assertInstanceOf (PictureDTO::class, $pictureDTO);
    }
  }
  