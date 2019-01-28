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

use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
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
	private $addTrickTypeHandler;

	/**
	 * @var TrickRepositoryInterface
	 */
	private $trickRepository;
  
  /**
   * AddTrickAction constructor.
   *
   * @param FormFactoryInterface         $formFactory
   * @param AddTrickTypeHandlerInterface $addTrickTypeHandler
   * @param TrickRepositoryInterface     $trickRepository
   */
	public function __construct(
      FormFactoryInterface $formFactory,
      AddTrickTypeHandlerInterface $addTrickTypeHandler,
      TrickRepositoryInterface $trickRepository
	) {
		$this->formFactory = $formFactory;
		$this->addTrickTypeHandler = $addTrickTypeHandler;
		$this->trickRepository = $trickRepository;
	}

	/**
	 * @Route("/add/trick", name="addTrick")
	 *
	 * @param ResponderAddTrickInterface $responderAddTrick
	 * @param Request                    $request
	 *
	 * @return Response
	 */
	public function __invoke(
		ResponderAddTrickInterface $responderAddTrick,
		Request $request
	):  Response {

		$addTrickType = $this->formFactory
			->create(AddTrickType::class)
			->handleRequest($request);

		if ($this->addTrickTypeHandler->handle($addTrickType)){
			return $responderAddTrick(true);
		}

		return $responderAddTrick(false,[
			'form' => $addTrickType->createView()
		]);
	}
}
