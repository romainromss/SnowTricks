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

use App\Domain\DTO\Interfaces\MoviesDTOInterface;

/**
 * Class MoviesDTO.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MoviesDTO implements MoviesDTOInterface
{
  /**
   * @var string
   */
  public $embed;
  
  /**
   * @var string
   */
  public $legend;
  
  public function __construct(
    string $embed = null,
    string $legend = null
  ) {
    $this->embed = $embed;
    $this->legend = $legend;
  }
}