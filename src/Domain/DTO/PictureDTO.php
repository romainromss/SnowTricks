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
  
  namespace App\Domain\DTO;
  
  use App\Domain\DTO\Interfaces\PictureDTOInterface;
  use Symfony\Component\HttpFoundation\File\UploadedFile;

  class PictureDTO implements PictureDTOInterface
  {
    
    /**
     * @var UploadedFile
     */
    public $file;
  
    /**
     * @var string
     */
    public $legend;
  
    /**
     * @var bool
     */
    public $first = false;
  
    /**
     * {@inheritdoc}
     */
    public function __construct(
      UploadedFile $file = null,
      string $legend = null,
      bool $first = false
    )
    {
      $this->file = $file;
      $this->legend = $legend;
      $this->first = $first;
    }
  }
  