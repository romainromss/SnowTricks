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

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
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
   * {@inheritdoc}
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
      dump($picture);
    }
    
    return $value;
  }
  
  /**
   * {@inheritdoc}
   */
  public function reverseTransform($value)
  {
    
    if (\count($value) == 0) {
      return $value;
    }
    
    return $value;
  }
}
