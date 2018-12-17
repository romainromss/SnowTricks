<?php

declare(strict_types=1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Factory;

use App\Domain\Factory\Interfaces\TrickFactoryInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Trick;

/**
 * Class TrickFactory.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TrickFactory implements TrickFactoryInterface
{
  /**
   * @param string         $name
   * @param string         $description
   * @param string         $category
   * @param UsersInterface $user
   * @param array          $picture
   * @param array          $movie
   *
   * @return TrickInterface
   */
	public function create(
      string $name,
      string $description,
      string $category,
      UsersInterface $user,
      array $picture,
      array $movie
	): TrickInterface {
		return new Trick($name, $description, $category, $user, $picture, $movie);
	}
}
