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
  
  namespace App\Domain\DTO\Interfaces;
  
  use Symfony\Component\HttpFoundation\File\UploadedFile;

  interface PictureDTOInterface
  {
    /**
     * PictureDTO constructor.
     *
     * @param UploadedFile $file
     * @param string       $legend
     * @param bool         $first
     */
    public function __construct (
      UploadedFile $file,
      string $legend,
      bool $first = false
    );
  }
  