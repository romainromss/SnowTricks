<?php

declare(strict_types=1);

/*
 * This file is part of the snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Factory\Interfaces;

use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UsersInterface;

interface TrickFactoryInterface
{
	/**
	 * @param string                  $name
	 * @param string                  $description
	 * @param string                  $group
	 * @param string | UsersInterface $users
	 * @param array                   $pictures
	 * @param array                   $movies
	 *
	 * @return TrickInterface
	 */
	public function create(
      string $name,
      string $description,
      string $group,
      UsersInterface $users,
      array $pictures,
      array $movies
	):  TrickInterface;
}
