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

namespace App\Tests\Domain\DTO;


use App\Domain\DTO\AddTrickDTO;
use PHPUnit\Framework\TestCase;

/**
 * Class AddTrickDtoUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickDtoUnitTest extends TestCase
{
	public function testConstruct()
	{
		$name = 'name';
		$description = 'description';
		$group = 'group';
		$pictures = ['pictures'];
		$movies = ['movies'];

		$tricksDtoConstruct = new AddTrickDTO($name, $description, $group, $pictures, $movies);
		static::assertInstanceOf(AddTrickDTO::class, $tricksDtoConstruct);
	}
}
