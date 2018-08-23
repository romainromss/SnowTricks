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

namespace App\UI\Form\DataTransformer;

use App\Domain\DTO\Interfaces\PictureDTOInterface;
use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\Models\Pictures;
use App\Infra\Helper\Interfaces\UploaderHelperInterface;
use App\Infra\Helper\UploaderHelper;
use App\UI\Form\DataTransformer\Interfaces\PicturesToFileTransformerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class PicturesToFIleTransformer.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PicturesToFIleTransformer implements DataTransformerInterface, PicturesToFileTransformerInterface
{
  /**
   * @var string
   */
  private $imageFolder;
  /**
   * @var UploaderHelper
   */
  private $uploaderHelper;
  
  /**
   * PicturesToFIleTransformer constructor.
   *
   * @param string                  $imageFolder
   * @param UploaderHelper $uploaderHelper
   */
  public function __construct(string $imageFolder, UploaderHelper $uploaderHelper)
  {
    $this->imageFolder = $imageFolder;
    $this->uploaderHelper = $uploaderHelper;
  }
  
  /**
   * @param UpdateTrickDTOInterface $value
   *
   * @return UpdateTrickDTOInterface
   */
  public function transform($value)
  {
    if (!$value instanceof UpdateTrickDTOInterface) {
      return;
    }
    
    if (\count($value->pictures) == 0) {
      return $value;
    }
    
    $pictures = [];
    
    foreach ($value->pictures as $picture) {
      $pictures[] = new File($this->imageFolder.$picture->getName());
      $value->pictures = array_replace($value->pictures, $pictures);
    }
    
    return $value;
  }
  
  /**
   * @param PictureDTOInterface $value
   *
   * @return PictureDTOInterface
   */
  public function reverseTransform($value)
  {
    if (\count($value->pictures) == 0) {
      return $value;
    }
    
    $pictures = [];
    
    foreach ($value->pictures as $pictureDTO) {
      $fileName = $this->uploaderHelper->upload($pictureDTO->file);
      $pictures[] = new Pictures($fileName, $pictureDTO->legend, $pictureDTO->first);
      $value->pictures = array_replace($value->pictures, $pictures);
    }
    
    return $value;
  }
}
