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
use App\Infra\Helper\UploaderHelper;
use App\UI\Form\DataTransformer\MoviesToFileTransformer;
use App\UI\Form\DataTransformer\PicturesToFIleTransformer;
use App\UI\Form\Type\PictureType;
use App\UI\Form\Type\UpdateTrickType;
use App\UI\Subscriber\MovieUpdateSubscriber;
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
	 * @var MoviesToFileTransformer
	 */
	private $movieToFileTransformer;

	/**
	 * @var PicturesToFIleTransformer
	 */
	private $picturesToFileTransformer;
  
  /**
   * @var UploaderHelper
   */
	private $uploader;

	protected function setUp()
	{
	  $this->uploader = $this->createMock(UploaderHelper::class);
	  
		$this->dto = new UpdateTrickDTO(
			'name' ,
			'description',
			'group',
			[],
			[]
		);
		$this->movieToFileTransformer  = new MoviesToFileTransformer();
		$this->picturesToFileTransformer = new PicturesToFIleTransformer(__DIR__."./../../../assets/", $this->uploader);

		parent::setUp();
	}

	public function testConstruct()
	{
		$updateTrickType = new UpdateTrickType($this->picturesToFileTransformer, $this->movieToFileTransformer);
		static::assertInstanceOf(UpdateTrickType::class, $updateTrickType);
	}

	protected function getExtensions()
	{
		$type = new UpdateTrickType($this->picturesToFileTransformer, $this->movieToFileTransformer);
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
			'pictures' => PictureType::class,
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

