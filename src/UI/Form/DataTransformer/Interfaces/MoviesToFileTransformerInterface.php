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

interface MoviesToFileTransformerInterface
{
  /**
   * @param mixed $value
   *
   * @return mixed|void
   * @throws \Exception
   */
  public function transform($value);
  
  /**
   * @param mixed $value
   *
   * @return mixed
   */
  public function reverseTransform($value);
}