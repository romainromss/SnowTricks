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

namespace App\UI\Actions;

use App\Domain\DTO\UpdateTricksDTO;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Form\Handler\UpdateTricksTypeHandler;
use App\UI\Form\Handler\UpdateTrickTypeHandler;
use App\UI\Responder\Interfaces\ResponderUpdateTrickInterface;
use App\UI\Responder\Interfaces\ResponderUpdateTricksInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateTricksAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickAction
{
	/**
	 * @var FormFactoryInterface
	 */
	private $formFactory;

	/**
	 * @var UpdateTrickTypeHandler
	 */
	private $updateTricksTypeHandler;

	/**
	 * @var TricksRepositoryInterface
	 */
	private $tricksRepository;

	/**
	 * UpdateTrickAction constructor.
	 *
	 * @param FormFactoryInterface       $formFactory
	 * @param UpdateTrickTypeHandler     $updateTricksTypeHandler
	 * @param TricksRepositoryInterface  $tricksRepository
	 */
	public function __construct(
		FormFactoryInterface $formFactory,
		UpdateTrickTypeHandler $updateTricksTypeHandler,
		TricksRepositoryInterface $tricksRepository
	) {
		$this->formFactory = $formFactory;
		$this->updateTricksTypeHandler = $updateTricksTypeHandler;
		$this->tricksRepository = $tricksRepository;
	}

	/**
	 * @param ResponderUpdateTrickInterface  $responderUpdateTricks
	 * @param Request                        $request
	 *
	 * @return Response
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function __invoke(
		ResponderUpdateTrickInterface $responderUpdateTricks,
		Request $request
	):  Response {

		$tricks = $this->tricksRepository->getBySlug($request->attributes->get('id'));

		$updateTricksType = $this->formFactory
			->create(Form::class, new UpdateTricksDTO(
				$tricks->getName(),
				$tricks->getDescription(),
				$tricks->getGroup(),
				$tricks->getSlug(),
				$tricks->getPictures()->toArray(),
				$tricks->getMovies()->toArray()
			))
			->handleRequest($request);

		if ($this->updateTricksTypeHandler->handle($updateTricksType)){
			return $responderUpdateTricks(true);
		}

		return $responderUpdateTricks(false,[
			'tricks' => $tricks,
			'form' => $updateTricksType->createView()
		], $updateTricksType);
	}
}
