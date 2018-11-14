<?php

declare(strict_types = 1);

/*
 * This file is part of the ${project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\DataTransformer\Interfaces;

use App\Domain\DTO\Interfaces\PictureDTOInterface;
use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;

interface PicturesToFileTransformerInterface
{
  /**
   * @param UpdateTrickDTOInterface $value
   *
   * @return UpdateTrickDTOInterface
   */
  public function transform($value);
  
  /**
   * @param PictureDTOInterface $value
   *
   * @return PictureDTOInterface
   * @throws \Exception
   */
  public function reverseTransform($value);
}