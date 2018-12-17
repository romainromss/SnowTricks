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

use App\Domain\Factory\CommentFactory;
use App\Domain\Factory\Interfaces\CommentFactoryInterface;
use App\Domain\DTO\AddCommentDTO;
use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use App\UI\Form\Handler\AddCommentTypeHandler;
use App\UI\Form\Handler\Interfaces\AddCommentTypeHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class AddCommentTypeHandlerTest extends KernelTestCase
{
    /**
     * @var CommentFactoryInterface
     */
    private $commentBuilder;

    /**
     * @var CommentRepositoryInterface
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
	 * @var TrickInterface
	 */
	private $tricksInterface;

	protected function setUp()
    {
        $this->commentBuilder = $this->createMock(CommentFactoryInterface::class);
        $this->commentRepository = $this->createMock(CommentRepositoryInterface::class);
		$this->tricksInterface = $this->createMock(TrickInterface::class);
		$this->tokenstorage = $this->createMock(TokenStorage::class);
		$token = $this->createMock(TokenInterface::class);
		$this->tokenstorage->method('getToken')->willReturn($token);
		$token->method('getUser')->willReturn($this->createMock(UsersInterface::class));
		$this->formInterface = $this->createMock(FormInterface::class);
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

		$this->commentRepository->save($comment = $this->createMock(CommentFactory::class));

		static::assertInstanceOf(
			AddCommentTypeHandlerInterface::class,
			$addCommentTypeHandler
		);

		static::assertTrue(
			$addCommentTypeHandler->handle($this->formInterface, $this->tricksInterface)
		);
    }
}
