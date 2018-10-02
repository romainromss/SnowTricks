<?php

declare(strict_types = 1);

/*
 * This file is part of the Symfony project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Factory;

use App\Domain\Factory\Interfaces\PictureFactoryInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Pictures;
use App\Infra\Helper\UploaderHelper;

/**
 * Class PictureFactory.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PictureFactory implements PictureFactoryInterface
{
  /**
   * @var UploaderHelper
   */
  private $uploaderHelper;
  
  /**
   * PictureFactory constructor.
   *
   * @param UploaderHelper $uploaderHelper
   */
  public function __construct(UploaderHelper $uploaderHelper)
  {
    $this->uploaderHelper = $uploaderHelper;
  }
  
  /**
   *{@inheritdoc}
   */
  public function create(
    string $name,
    string $legend,
    bool $first
  ): PicturesInterface {
    return new Pictures($name, $legend, $first);
  }
  
  /**
   * @param array $pictures
   *
   * @return array|mixed|void
   *
   * @throws \Exception
   */
  public function createFromArray(array $pictures = [])
  {
    if (\count($pictures) == 0) {
      return;
    }
    
    $entries = [];
    foreach ($pictures as $picture) {
      $fileName = $this->uploaderHelper->upload($picture->file);
  
      $picture->first = false;
      if (\count($pictures) > 0) {
        $pictures[0]->first = true;
      }
      
      $entries[] = new Pictures($fileName, $picture->legend, $picture->first);
    }
    
    return $entries;
  }
}
