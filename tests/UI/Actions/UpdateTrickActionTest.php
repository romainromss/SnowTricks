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

namespace App\Tests\UI\Actions;

use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Repository\TricksRepository;
use App\UI\Actions\UpdateTrickAction;
use App\UI\Form\Handler\Intefaces\UpdateTricksTypeHandlerInterface;
use App\UI\Form\Handler\UpdateTricksTypeHandler;
use App\UI\Responder\ResponderUpdateTricks;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class UpdateTrickActionTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickActionTest extends TestCase
{
	/**
	 * @var FormFactoryInterface
	 */
	private $formFactory;
	/**
	 * @var Environment
	 */
	private $twig;
	/**
	 * @var UrlGeneratorInterface
	 */
	private $urlGenerator;
	/**
	 * @var Request
	 */
	private $request;
	/**
	 * @var UpdateTricksTypeHandler
	 */
	private $updateTrickTypeHandler;
	/**
	 * @var TricksRepository
	 */
	private $tricksRepository;
	/**
	 * @var TricksInterface
	 */
	private $tricks;

	public function setUp()
	{
		$this->formFactory = $this->createMock(FormFactoryInterface::class);
		$this->twig = $this->createMock(Environment::class);
		$this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
		$this->urlGenerator->method('generate')->willReturn('/');
		$this->request = Request::create('/tricks/details/mute', 'POST');
		$this->updateTrickTypeHandler = $this->createMock(UpdateTricksTypeHandlerInterface::class);
		$this->tricksRepository = $this->createMock(TricksRepository::class);
		$this->tricks = $this->createMock(TricksInterface::class);
		$this->tricksRepository->method('getBySlug')->willReturn($this->tricks);
	}


	public function testConstructor()
	{
		$constructResponder = new UpdateTrickAction(
			$this->formFactory,
			$this->updateTrickTypeHandler,
			$this->tricksRepository);

		static::assertInstanceOf(
			UpdateTrickAction::class,
			$constructResponder
		);
	}


	/**
	 * @return ResponderUpdateTricks
	 *
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function testReturnFalse()
	{
		$updateTrickAction = new UpdateTrickAction(
			$this->formFactory,
			$this->updateTrickTypeHandler,
			$this->tricksRepository
		);

		$responder = new ResponderUpdateTricks(
			$this->twig,
			$this->urlGenerator
		);

		$this->updateTrickTypeHandler->method('handle')->willReturn(false);

		static::assertInstanceOf(Response::class, $updateTrickAction(
			$responder,
			$this->request
		));
		return $responder;

	}

	/**
	 * @return Response
	 *
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function testReturnTrue()
	{
		$updateTrickAction = new UpdateTrickAction(
			$this->formFactory,
			$this->updateTrickTypeHandler,
			$this->tricksRepository
		);

		$responder = new ResponderUpdateTricks(
			$this->twig,
			$this->urlGenerator
		);

		$this->updateTrickTypeHandler->method('handle')->willReturn(true);

		static::assertInstanceOf(Response::class, $updateTrickAction(
			$responder,
			$this->request
		));
		return $responder(true);
	}
}
