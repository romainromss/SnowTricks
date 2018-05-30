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

namespace App\Tests\UI\Form\Handler;

use App\Domain\Builder\TrickBuilder;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Repository\TricksRepository;
use App\UI\Form\Handler\Intefaces\UpdateTrickTypeHandlerInterface;
use App\UI\Form\Handler\UpdateTrickTypeHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Class UpdateTrickTypeHandlerTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickTypeHandlerTest extends TestCase
{
	/**
	 * @var TrickBuilder
	 */
	private $tricksBuilder;

	/**
	 * @var TricksRepository
	 */
	private $tricksRepository;

	/**
	 * @var TokenStorageInterface
	 */
	private $tokenstorage;

	/**
	 * @var FormInterface
	 */
	private $formInterface;

	protected function setUp()
	{
		$this->tricksBuilder = $this->createMock(TrickBuilder::class);
		$this->tricksRepository = $this->createMock(TricksRepository::class);
		$this->tokenstorage = $this->createMock(TokenStorageInterface::class);
		$token = $this->createMock(TokenInterface::class);
		$this->tokenstorage->method('getToken')->willReturn($token);
		$token->method('getUser')->willReturn($this->createMock(UsersInterface::class));
		$this->formInterface = $this->createMock(FormInterface::class);
	}


	public function testConstruct()
	{
		$updateTrickTypeHandler = new UpdateTrickTypeHandler($this->tricksBuilder, $this->tricksRepository, $this->tokenstorage);
		static::assertInstanceOf(UpdateTrickTypeHandlerInterface::class, $updateTrickTypeHandler);
	}

	/**
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function testHandleReturnFalse()
	{
		$updateTrickTypeHandler = new UpdateTrickTypeHandler(
			$this->tricksBuilder,
			$this->tricksRepository,
			$this->tokenstorage
		);

		static::assertInstanceOf(
			UpdateTrickTypeHandlerInterface::class,
			$updateTrickTypeHandler
		);

		static::assertFalse(
			$updateTrickTypeHandler->handle($this->formInterface)
		);
	}


	/**
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function testHandleReturnTrue()
	{
		$addTrickDTO = new UpdateTrickDTO(
			'name',
			'description',
			'group',
			'slug',
			['pictures'],
			['movies']
		);

		$this->formInterface->method('isValid')->willReturn(true);
		$this->formInterface->method('isSubmitted')->willReturn(true);
		$this->formInterface->method('getData')->willReturn($addTrickDTO);


		$updateTrickTypeHandler = new UpdateTrickTypeHandler(
			$this->tricksBuilder,
			$this->tricksRepository,
			$this->tokenstorage
		);

		$this->tricksRepository->save($this->tricksBuilder->getTrick());

		static::assertInstanceOf(
			UpdateTrickTypeHandlerInterface::class,
			$updateTrickTypeHandler
		);

		static::assertTrue(
			$updateTrickTypeHandler->handle($this->formInterface)
		);
	}
}
