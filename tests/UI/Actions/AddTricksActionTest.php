<?php

declare(strict_types=1);

/*
 * This file is part of the ${project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Actions;

use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Actions\AddTricksAction;
use App\UI\Form\Handler\Intefaces\AddTricksTypeHandlerInterface;
use App\UI\Responder\ResponderAddTricks;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class AddTricksActionTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTricksActionTest extends KernelTestCase
{
	/**
	 * @var FormFactoryInterface
	 */
	private $formFactory;
	/**
	 * @var AddTricksTypeHandlerInterface
	 */
	private $addTricksTypeHandler;
	/**
	 * @var TricksRepositoryInterface
	 */
	private $tricksRepository;
	/**
	 * @var UrlGeneratorInterface
	 */
	private $urlGenerator;
	/**
	 * @var Request
	 */
	private $request;
	/**
	 * @var Environment
	 */
	private $twig;


	public function setUp()
	{
		static::bootKernel();
		$this->formFactory = static::$kernel->getContainer()->get('form.factory');
		$this->addTricksTypeHandler = $this->createMock(AddTricksTypeHandlerInterface::class);
		$this->tricksRepository = $this->createMock(TricksRepositoryInterface::class);
		$this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
		$this->urlGenerator->method('generate')->willReturn('/');
		$this->request = Request::create('/addtricks', 'POST');
		$this->twig = $this->createMock(Environment::class);
	}

	public function testConstructor()
	{
		$constructResponder = new AddTricksAction($this->formFactory, $this->addTricksTypeHandler, $this->tricksRepository);
		static::assertInstanceOf(AddTricksAction::class, $constructResponder);
	}

	/**
	 * @return ResponderAddTricks
	 */
	public function testReturnFalse()
	{
		$addTricksAction = new AddTricksAction($this->formFactory, $this->addTricksTypeHandler, $this->tricksRepository);
		$responder = new ResponderAddTricks($this->twig, $this->urlGenerator);

		$this->addTricksTypeHandler->method('handle')->willReturn(false);

		static::assertInstanceOf(Response::class, $addTricksAction(
			$responder,
			$this->request
		));
		return $responder;

	}

	/**
	 * @return Response
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function testReturnTrue()
	{
		$addTricksAction = new AddTricksAction($this->formFactory, $this->addTricksTypeHandler, $this->tricksRepository);
		$responder = new ResponderAddTricks($this->twig, $this->urlGenerator);

		$this->addTricksTypeHandler->method('handle')->willReturn(true);

		static::assertInstanceOf(Response::class, $addTricksAction(
			$responder,
			$this->request
		));
		return $responder(true);

	}
}