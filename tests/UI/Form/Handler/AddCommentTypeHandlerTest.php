<?php

declare(strict_types=1);

/*
 * This file is part of the SnowTricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Form\Handler;

use App\Domain\Builder\Interfaces\CommentBuilderInterface;
use App\Domain\DTO\AddCommentDTO;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Repository\Interfaces\CommentsRepositoryInterface;
use App\UI\Form\Handler\AddCommentTypeHandler;
use App\UI\Form\Handler\Intefaces\AddCommentTypeHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class AddCommentTypeHandlerTest extends KernelTestCase
{
    /**
     * @var CommentBuilderInterface
     */
    private $commentBuilder;

    /**
     * @var CommentsRepositoryInterface
     */
    private $commentRepository;

	/**
	 * @var TokenStorageInterface
	 */
    private $tokenstorage;

	/**
	 * @var FormInterface
	 */
	private $formInterface;

	/**
	 * @var TricksInterface
	 */
	private $tricksInterface;

	public function setUp()
    {
    	static::BootKernel();
        $this->commentBuilder = $this->createMock(CommentBuilderInterface::class);
        $this->commentRepository = $this->createMock(CommentsRepositoryInterface::class);
        $this->tokenstorage = static::$kernel->getContainer()->get('security.token_storage');
        $this->formInterface = $this->createMock(FormInterface::class);
        $this->tricksInterface = $this->createMock(TricksInterface::class);
    }

    public function testConstruct()
    {
        $addCommentTypeHandler = new AddCommentTypeHandler($this->commentBuilder, $this->commentRepository, $this->tokenstorage);
        static::assertInstanceOf(AddCommentTypeHandler::class, $addCommentTypeHandler);
    }

    public function testHandleReturnFalse()
	{
		$addCommentTypeHandler = new AddCommentTypeHandler(
			$this->commentBuilder,
			$this->commentRepository,
			$this->tokenstorage
		);

		static::assertInstanceOf(
			AddCommentTypeHandlerInterface::class,
			$addCommentTypeHandler
		);
		static::assertFalse(
			$addCommentTypeHandler->handle($this->formInterface, $this->tricksInterface)
		);
	}


	public function testHandleReturnTrue()
    {
		$addCommentDTO = new AddCommentDTO(
			'content'
		);

		$this->formInterface->method('isValid')->willReturn(true);
		$this->formInterface->method('isSubmitted')->willReturn(true);
		$this->formInterface->method('getData')->willReturn($addCommentDTO);


		$addCommentTypeHandler = new AddCommentTypeHandler(
			$this->commentBuilder,
			$this->commentRepository,
			$this->tokenstorage
		);

		$this->commentRepository->save($this->commentBuilder->getComment());

		static::assertInstanceOf(
			AddCommentTypeHandlerInterface::class,
			$addCommentTypeHandler
		);

		static::assertTrue(
			$addCommentTypeHandler->handle($this->formInterface, $this->tricksInterface)
		);
    }
}
