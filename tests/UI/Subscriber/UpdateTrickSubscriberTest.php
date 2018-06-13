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

namespace App\Tests\UI\Subscriber;

use App\UI\Subscriber\UpdateTrickSubscriber;
use PHPUnit\Framework\TestCase;

/**
 * Class UpdateTrickSubscriberTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickSubscriberTest extends TestCase
{
	/**
	 * @var array
	 */
	private $pictures = [];

	/**
	 * @var array
	 */
	private $movies = [];

	/**
	 * @var string
	 */
	private $imageFolder;

	/**
	 * UpdateTrickSubscriberTest constructor.
	 *
	 */
	public function SetUp()
	{
		$this->imageFolder = $this->createMock($this->imageFolder);
	}

	public function InstanceOf()
	{
		$updateTrickSubscriber = new UpdateTrickSubscriber($this->imageFolder);


	}
}