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
use App\Domain\DTO\AddTrickDTO;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Repository\TricksRepository;
use App\UI\Form\Handler\AddTrickTypeHandler;
use App\UI\Form\Handler\Intefaces\AddTrickTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class AddTricksTypeHandlerTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickTypeHandlerTest extends TestCase
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
		$addTricksTypeHandler = new AddTrickTypeHandler($this->tricksBuilder, $this->tricksRepository, $this->tokenstorage);
		static::assertInstanceOf(AddTrickTypeHandlerInterface::class, $addTricksTypeHandler);
	}

	/**
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function testHandleReturnFalse()
	{
		$addTricksTypeHandler = new AddTrickTypeHandler(
			$this->tricksBuilder,
			$this->tricksRepository,
			$this->tokenstorage
		);

		static::assertInstanceOf(
			AddTrickTypeHandlerInterface::class,
			$addTricksTypeHandler
		);

		static::assertFalse(
			$addTricksTypeHandler->handle($this->formInterface)
		);
	}


	/**
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function testHandleReturnTrue()
	{
		$addTrickDTO = new AddTrickDTO(
			'name',
			'description',
			'group',
			['pictures'],
			['movies']
		);

		$this->formInterface->method('isValid')->willReturn(true);
		$this->formInterface->method('isSubmitted')->willReturn(true);
		$this->formInterface->method('getData')->willReturn($addTrickDTO);


		$addTrickTypeHandler = new AddTrickTypeHandler(
			$this->tricksBuilder,
			$this->tricksRepository,
			$this->tokenstorage
		);

		$this->tricksRepository->save($this->tricksBuilder->getTrick());

		static::assertInstanceOf(
			AddTrickTypeHandlerInterface::class,
			$addTrickTypeHandler
		);

		static::assertTrue(
			$addTrickTypeHandler->handle($this->formInterface)
		);
	}
}
