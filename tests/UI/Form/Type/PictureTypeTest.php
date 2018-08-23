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
  
  namespace App\Tests\UI\Form\Type;

  use App\Domain\DTO\PictureDTO;
  use App\UI\Form\Type\PictureType;
  use Symfony\Component\Form\Extension\Core\Type\FileType;
  use Symfony\Component\Form\PreloadedExtension;
  use Symfony\Component\Form\Test\TypeTestCase;
  use Symfony\Component\Form\Tests\Extension\Core\Type\FileTypeTest;
  use Symfony\Component\HttpFoundation\File\File;
  use Symfony\Component\HttpFoundation\File\UploadedFile;

  /**
   * Class PictureTypeTest.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class PictureTypeTest extends TypeTestCase
  {
  
    protected function getExtensions()
    {
      $type = new PictureType();
      return [
        new PreloadedExtension([$type], [])
      ];
    }
    
    public function testGoodData()
    {
      $form = $this->factory->create(PictureType::class);
      $form->submit([
        'file' => new UploadedFile(__DIR__.'/../../../assets/360.svg','360.svg'),
        'legend' => 'legend'
      ]);
      static::assertTrue($form->isSynchronized());
      static::assertTrue (
        $form->isSubmitted ()
      );
      
      static::assertTrue (
        $form->isValid ()
      );
    }
  }
  