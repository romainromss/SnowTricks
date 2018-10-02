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

namespace  App\Tests\Infra\Helper;

use App\Infra\Helper\UploaderHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class UploaderHelperUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UploaderHelperUnitTest extends TestCase
{
  /**
   * @var string
   */
  private $imageFolder;
  
  protected function setUp()
  {
    $this->imageFolder = '360.svg';
  }
  
  public function testInstanceOf()
  {
    $uploaderHelper = new UploaderHelper($this->imageFolder);
    static::assertInstanceOf(UploaderHelper::class, $uploaderHelper);
  }
  
  /**
   * @param string $fileName
   * @param string $extension
   *
   * @dataProvider provideValues
   */
  public function testUpload(string $fileName, string $extension)
  {
    $fileMock = $this->createMock(File::class);
    $fileMock->method('getFilename')->willReturn($fileName);
    $fileMock->method('guessExtension')->willReturn($extension);
    
    $uploaderHelper = new UploaderHelper($this->imageFolder);
    $newFileName = $uploaderHelper->upload($fileMock);
    static::assertNotNull($newFileName);
  }
  
  /**
   * @return \Generator
   */
  public function provideValues()
  {
    yield array('toto', 'jpg');
    yield array('tata', 'png');
    yield array('tato', 'svg');
  }
}