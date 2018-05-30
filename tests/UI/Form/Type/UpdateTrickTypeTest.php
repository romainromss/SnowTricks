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

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\UpdateTrickDTO;
use App\UI\Form\Type\UpdateTrickType;
use App\UI\Subscriber\UpdateTrickSubscriber;
use Symfony\Component\Form\Test\TypeTestCase;


/**
 * Class UpdateTrickTypeTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickTypeTest extends TypeTestCase
{
	/**
	 * @var UpdateTrickDTO
	 */
	private $dto;

	/**
	 * @var UpdateTrickSubscriber
	 */
	private $updateTrickSubscriber;

	protected function setUp()
	{
		parent::setUp();

		$this->dto = new UpdateTrickDTO(
			'name' ,
			'description',
			'group',
			'slug',
			[],
			[]
		);

		$this->updateTrickSubscriber  = $this->createMock(UpdateTrickSubscriber::class);
	}

	public function testConstruct()
	{
		$updateTrickType = new UpdateTrickType($this->updateTrickSubscriber);
		static::assertInstanceOf(UpdateTrickType::class, $updateTrickType);
	}

	public function testGoodData()
	{
		$form = $this->factory->create(UpdateTrickType::class, $this->dto);
		$form->submit($this->dto);

		static::assertTrue(
			$form->isSubmitted()
		);

		static::assertTrue(
			$form->isValid()
		);
	}
}
