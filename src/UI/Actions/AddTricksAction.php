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
use App\UI\Form\Handler\Intefaces\AddTricksTypeHandlerInterface;
use App\UI\Form\Type\AddTricksType;
use App\UI\Responder\Interfaces\ResponderAddTricksInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class AddTricksAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTricksAction
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
	 * AddTricksAction constructor.
	 *
	 * @param FormFactoryInterface           $formFactory
	 * @param AddTricksTypeHandlerInterface  $addTricksTypeHandler
	 * @param TricksRepositoryInterface      $tricksRepository
	 */
	public function __construct(
		FormFactoryInterface $formFactory,
		AddTricksTypeHandlerInterface $addTricksTypeHandler,
		TricksRepositoryInterface $tricksRepository
	) {
		$this->formFactory = $formFactory;
		$this->addTricksTypeHandler = $addTricksTypeHandler;
		$this->tricksRepository = $tricksRepository;
	}

	/**
	 * @Route("/addtricks", name="addTricks")
	 *
	 * @param ResponderAddTricksInterface $responderAddTricks
	 * @param Request                     $request
	 *
	 * @return Response
	 */
	public function __invoke(
		ResponderAddTricksInterface $responderAddTricks,
		Request $request
	):  Response {

		$addTricksType = $this->formFactory
			->create(AddTricksType::class)
			->handleRequest($request);

		if ($this->addTricksTypeHandler->handle($addTricksType)){
			return $responderAddTricks(true);
		}

		return $responderAddTricks(false,[
			'form' => $addTricksType->createView()
		]);
	}
}
