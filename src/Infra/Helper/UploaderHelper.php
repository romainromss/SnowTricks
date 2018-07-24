<?php

declare(strict_types = 1);

/*
 * This file is part of the Snowtrick project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infra\Helper;

class UploadeHelper
{
  public $imageFolder;
  
  public function upload(\SplFileInfo $fileInfo)
  {
    $fileName = md5(uniqid(str_rot13($fileInfo->getFilename()))).'.'.$fileInfo->guessExtension();
    $fileInfo->move($this->imageFolder, $fileName);
    
    return $fileName;
  }
}
