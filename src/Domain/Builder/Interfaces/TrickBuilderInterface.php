<?php

declare(strict_types=1);

/*
 * This file is part of the ${project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Builder\Interfaces;


use App\Domain\Builder\TrickBuilder;
use App\Domain\Models\Interfaces\CommentsInterface;
use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Tricks;

interface TrickBuilderInterface
{

	/**
	 * @param string  $name
	 * @param string  $description
	 * @param string  $group
	 * @param string  $slug
	 * @param string | UsersInterface  $users
	 * @param array   $pictures
	 * @param array   $movies
	 *
	 * @return TrickBuilder
	 */
	public function create(
		string $name,
		string $description,
		string $group,
		string $slug,
		UsersInterface $users,
		array $pictures,
		array $movies
	):  TrickBuilder;

	/**
	 * @return Tricks
	 */
	public function getTrick(): Tricks;
}