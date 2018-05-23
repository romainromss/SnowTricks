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

namespace App\Tests\Domain\Builder;

use App\Domain\Builder\TrickBuilder;
use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Tricks;
use PHPUnit\Framework\TestCase;

/**
 * Class TrickBuilderTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TrickBuilderTest extends TestCase
{
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $description;
	/**
	 * @var string
	 */
	private $group;
	/**
	 * @var string
	 */
	private $slug;
	/**
	 * @var UsersInterface
	 */
	private $users;
	/**
	 * @var
	 */
	private $pictures;
	/**
	 * @var
	 */
	private $movies;

	public function setUp()
	{
		$this->name = 'name';
		$this->description = 'description';
		$this->group = 'group';
		$this->slug = 'slug';
		$this->users = $this->createMock(UsersInterface::class);
		$this->pictures = ['picture'];
		$this->movies = ['movies'];
	}

	public function testInstanceOf()
	{
		$tricksBuilder = new TrickBuilder();
		static::assertInstanceOf(TrickBuilder::class, $tricksBuilder);
	}

	public function testcreate()
	{
		$comment = new TrickBuilder();
		$comment->create(
			$this->name,
			$this->description,
			$this->group,
			$this->slug,
			$this->users,
			$this->pictures,
			$this->movies
		);

		static::assertInstanceOf(Tricks::class, $comment->getTrick());
	}
}