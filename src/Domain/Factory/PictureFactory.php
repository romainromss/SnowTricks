<?php

declare(strict_types = 1);

/*
 * This file is part of the Symfony project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Builder;

use App\Domain\Builder\Interfaces\PictureFactoryInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Pictures;

/**
 * Class PictureFactory.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PictureFactory implements PictureFactoryInterface
{
  public function create(
    string $name,
    string $legend,
    bool $first
  ): PicturesInterface {
    return new Pictures($name, $legend, $first);
  }
}
