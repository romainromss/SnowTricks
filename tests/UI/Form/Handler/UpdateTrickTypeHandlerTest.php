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

use App\Domain\Factory\TrickFactory;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Repository\TrickRepository;
use App\UI\Form\Handler\Interfaces\UpdateTrickTypeHandlerInterface;
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
	 * @var TrickFactory
	 */
	private $trickFactory;

	/**
	 * @var TrickRepository
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
  
  /**
   * @var TrickInterface
   */
    private $tricks;
  
  protected function setUp()
	{
		$this->trickFactory = $this->createMock(TrickFactory::class);
		$this->tricksRepository = $this->createMock(TrickRepository::class);
		$this->tricks = $this->createMock(TrickInterface::class);
		$this->tokenstorage = $this->createMock(TokenStorageInterface::class);
		$token = $this->createMock(TokenInterface::class);
		
		$this->tokenstorage->method('getToken')->willReturn($token);
		$token->method('getUser')->willReturn($this->createMock(UserInterface::class));
		$this->formInterface = $this->createMock(FormInterface::class);
	}


	public function testConstruct()
	{
		$updateTrickTypeHandler = new UpdateTrickTypeHandler($this->trickFactory, $this->tricksRepository, $this->tokenstorage);
		static::assertInstanceOf(UpdateTrickTypeHandlerInterface::class, $updateTrickTypeHandler);
	}
 
 
	public function testHandleReturnFalse()
	{
		$updateTrickTypeHandler = new UpdateTrickTypeHandler(
		    $this->trickFactory,
			$this->tricksRepository,
			$this->tokenstorage
		);

		static::assertInstanceOf(
			UpdateTrickTypeHandlerInterface::class,
			$updateTrickTypeHandler
		);

		static::assertFalse(
			$updateTrickTypeHandler->handle($this->formInterface, $this->tricks)
		);
	}
	
	public function testHandleReturnTrue()
	{
		$addTrickDTO = new UpdateTrickDTO(
			'name',
			'description',
			'group',
			['pictures'],
			['movies']
		);

		$this->formInterface->method('isValid')->willReturn(true);
		$this->formInterface->method('isSubmitted')->willReturn(true);
		$this->formInterface->method('getData')->willReturn($addTrickDTO);


		$updateTrickTypeHandler = new UpdateTrickTypeHandler(
			$this->trickFactory,
			$this->tricksRepository,
			$this->tokenstorage
		);

		$this->tricksRepository->update();

		static::assertInstanceOf(
			UpdateTrickTypeHandlerInterface::class,
			$updateTrickTypeHandler
		);

		static::assertTrue(
			$updateTrickTypeHandler->handle($this->formInterface, $this->tricks)
		);
	}
}
