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

namespace App\Domain\DTO;

/**
 * Class UpdateTricksDTOInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTricksDTO
{
	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var string
	 */
	public $group;

	/**
	 * @var string
	 */
	public $slug;

	/**
	 * @var array
	 */
	public $pictures = [];

	/**
	 * @var array
	 */
	public $movies = [];


	public function serialize()
	{
		return serialize([
			$this->name,
			$this->description,
			$this->group,
			$this->slug,
			$this->pictures,
			$this->movies,
		]);
	}

	/**
	 * @param string $serialized
	 */
	public function unserialize($serialized)
	{
		list(
			$this->name,
			$this->description,
			$this->group,
			$this->slug,
			$this->pictures,
			$this->movies
			) = unserialize($serialized);
	}
}
