<?php

declare(strict_types=1);

/*
 * This file is part of the snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Actions;

use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use App\UI\Form\Type\AddTrickType;
use App\UI\Responder\Interfaces\ResponderAddTrickInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class AddTrickAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickAction
{
	/**
	 * @var FormFactoryInterface
	 */
	private $formFactory;

	/**
	 * @var AddTrickTypeHandlerInterface
	 */
	private $addTricksTypeHandler;

	/**
	 * @var TricksRepositoryInterface
	 */
	private $tricksRepository;

	/**
	 * AddTrickAction constructor.
	 *
	 * @param FormFactoryInterface         $formFactory
	 * @param AddTrickTypeHandlerInterface $addTricksTypeHandler
	 * @param TricksRepositoryInterface    $tricksRepository
	 */
	public function __construct(
		FormFactoryInterface $formFactory,
		AddTrickTypeHandlerInterface $addTricksTypeHandler,
		TricksRepositoryInterface $tricksRepository
	) {
		$this->formFactory = $formFactory;
		$this->addTricksTypeHandler = $addTricksTypeHandler;
		$this->tricksRepository = $tricksRepository;
	}

	/**
	 * @Route("/addtrick", name="addTricks")
	 *
	 * @param ResponderAddTrickInterface $responderAddTricks
	 * @param Request                    $request
	 *
	 * @return Response
	 */
	public function __invoke(
		ResponderAddTrickInterface $responderAddTricks,
		Request $request
	):  Response {

		$addTricksType = $this->formFactory
			->create(AddTrickType::class)
			->handleRequest($request);

		if ($this->addTricksTypeHandler->handle($addTricksType)){
			return $responderAddTricks(true);
		}

		return $responderAddTricks(false,[
			'form' => $addTricksType->createView()
		]);
	}
}
