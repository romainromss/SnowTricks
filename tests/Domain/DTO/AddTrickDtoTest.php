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

namespace App\Tests\Domain\DTO;


use App\Domain\DTO\AddTricksDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class AddTrickDtoTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickDtoTest extends TestCase
{
	public function testConstruct()
	{
		$name = 'name';
		$description = 'description';
		$group = 'group';
		$slug = 'slug';
		$pictures = ['pictures'];
		$movies = ['movies'];

		$tricksDtoConstruct = new AddTricksDTO($name, $description, $group, $slug, $pictures, $movies);
		static::assertInstanceOf(AddTricksDTO::class, $tricksDtoConstruct);
	}
}