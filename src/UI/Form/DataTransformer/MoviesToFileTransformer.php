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

namespace App\UI\Form\DataTransformer;

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\Models\Movies;
use App\UI\Form\DataTransformer\Interfaces\MoviesToFileTransformerInterface;
use Symfony\Component\Form\DataTransformerInterface;

class MoviesToFileTransformer implements DataTransformerInterface, MoviesToFileTransformerInterface
{
  /**
   * {@inheritdoc}
   */
  public function transform($value)
  {
    if (!$value instanceof UpdateTrickDTOInterface) {
      return;
    }
    
    if (\count($value->movies) == 0) {
      return $value;
    }
    
    $movies = [];
    
    foreach ($value->movies as $movie) {
      $movies[] = new Movies($movie->getEmbed(), $movie->getLegend());
      $value->movies = array_replace($value->movies, $movies);
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
