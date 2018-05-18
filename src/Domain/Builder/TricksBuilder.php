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

namespace App\Domain\Builder;

use App\Domain\Builder\Interfaces\TricksBuilderInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Tricks;

/**
 * Class TricksBuilder.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TricksBuilder implements TricksBuilderInterface
{
	/**
	 * @var Tricks
	 */
	private $tricks;

	/**
	 * @param string         $name
	 * @param string         $description
	 * @param string         $group
	 * @param string         $slug
	 * @param UsersInterface $users
	 * @param array          $pictures
	 * @param array          $movies
	 *
	 * @return TricksBuilder
	 */
	public function create(
		string $name,
		string $description,
		string $group,
		string $slug,
		UsersInterface $users,
		array $pictures,
		array $movies
	):  self {

		$this->tricks = new Tricks($name, $description, $group, $slug, $users, $pictures, $movies);
		return $this;
	}

	/**
	 * @return tricks
	 */
	public function getTricks(): Tricks
	{
		return $this->tricks;
	}
}
