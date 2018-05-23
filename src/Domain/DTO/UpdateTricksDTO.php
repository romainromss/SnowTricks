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

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;

/**
 * Class UpdateTricksDTOInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTricksDTO implements UpdateTrickDTOInterface
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

	/**
	 * {@inheritdoc}
	 */
	public function __construct(
		string $name,
		string $description,
		string $group,
		string $slug,
		array $pictures,
		array $movies
	) {
		$this->name = $name;
		$this->description = $description;
		$this->group = $group;
		$this->slug = $slug;
		$this->pictures = $pictures;
		$this->movies = $movies;
	}

}
