<?php

declare(strict_types=1);

/*
 * This file is part of the ${$project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Form\Handler;


use App\Domain\Builder\TricksBuilder;
use App\Domain\Repository\TricksRepository;
use App\UI\Form\Handler\AddTricksTypeHandler;
use App\UI\Form\Handler\Intefaces\AddTricksTypeHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class AddTricksTypeHandlerTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTricksTypeHandlerTest extends KernelTestCase
{
	/**
	 * @var TricksBuilder
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

	public function setUp()
	{
		static::BootKernel();
		$this->tricksBuilder = $this->createMock(TricksBuilder::class);
		$this->tricksRepository = $this->createMock(TricksRepository::class);
		$this->tokenstorage = static::$kernel->getContainer()->get('security.token_storage') ;
	}


	public function testConstruct()
	{
		$addTricksTypeHandler = new AddTricksTypeHandler($this->tricksBuilder, $this->tricksRepository, $this->tokenstorage);
		static::assertInstanceOf(AddTricksTypeHandlerInterface::class, $addTricksTypeHandler);
	}
}