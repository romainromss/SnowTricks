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

namespace App\Infra\Helper;

use App\Infra\Helper\Interfaces\UploaderHelperInterface;

/**
 * Class UploaderHelper.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UploaderHelper implements UploaderHelperInterface
{
  public $imageFolder;
  
  /**
   * UploaderHelper constructor.
   *
   * @param string $imageFolder
   */
  public function __construct(string $imageFolder)
  {
    $this->imageFolder = $imageFolder;
  }
  
  /**
   * @param \SplFileInfo $fileInfo
   *
   * @return string
   */
  public function upload(\SplFileInfo $fileInfo)
  {
    $fileName = md5(uniqid(str_rot13($fileInfo->getFilename()))).'.'.$fileInfo->guessExtension();
    $fileInfo->move($this->imageFolder, $fileName);
    
    return $fileName;
  }
}
