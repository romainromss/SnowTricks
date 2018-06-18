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
use App\UI\Form\DataTransformer\PicturesToFIleTransformer;
use App\UI\Form\Type\UpdateTrickType;
use App\UI\Subscriber\UpdateTrickSubscriber;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\PreloadedExtension;
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

	/**
	 * @var PicturesToFIleTransformer
	 */
	private $picturesToFileTransformer;

	protected function setUp()
	{
		$this->dto = new UpdateTrickDTO(
			'name' ,
			'description',
			'group',
			[],
			[]
		);
		$this->updateTrickSubscriber  = new UpdateTrickSubscriber(__DIR__."./../../../assets/");
		$this->picturesToFileTransformer = new PicturesToFIleTransformer(__DIR__."./../../../assets/");

		parent::setUp();
	}

	public function testConstruct()
	{
		$updateTrickType = new UpdateTrickType($this->updateTrickSubscriber, $this->picturesToFileTransformer);
		static::assertInstanceOf(UpdateTrickType::class, $updateTrickType);
	}

	protected function getExtensions()
	{
		$type = new UpdateTrickType($this->updateTrickSubscriber, $this->picturesToFileTransformer);
		return [
			new PreloadedExtension([$type], [])
		];
	}

	public function testGoodData()
	{
		$form = $this->factory->create(UpdateTrickType::class, $this->dto);
		$form->submit([
			'name' => 'name' ,
			'description' => 'description',
			'group' => 'group',
			'slug' => 'slug',
			'pictures' => [],
			'movies' => []
	]);

		static::assertInstanceOf(
			FormInterface::class,
			$form
		);

		static::assertTrue(
			$form->isSubmitted()
		);

		static::assertSame($this->dto,
			$form->getData()
		);

		static::assertTrue(
			$form->isValid()
		);

		static::assertNotNull(
			$form->getConfig()->getEmptyData()
		);
	}
}
