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

  class PictureDTO implements PictureDTOInterface
  {
    /**
     * @var string
     */
    public $name;
  
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
    public function __construct (
      string $name,
      string $legend,
      bool $first
    ) {
      $this->name = $name;
      $this->legend = $legend;
      $this->first = $first;
    }
  }
  