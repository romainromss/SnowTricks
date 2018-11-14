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

use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Tricks;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Form\Handler\UpdateTrickTypeHandler;
use App\UI\Form\Type\UpdateTrickType;
use App\UI\Responder\Interfaces\ResponderUpdateTrickInterface;
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
	private $updateTrickTypeHandler;

	/**
	 * @var TricksRepositoryInterface
	 */
	private $tricksRepository;

	/**
	 * UpdateTrickAction constructor.
	 *
	 * @param FormFactoryInterface       $formFactory
	 * @param UpdateTrickTypeHandler     $updateTrickTypeHandler
	 * @param TricksRepositoryInterface  $tricksRepository
	 */
	public function __construct(
		FormFactoryInterface $formFactory,
		UpdateTrickTypeHandler $updateTrickTypeHandler,
		TricksRepositoryInterface $tricksRepository
	) {
		$this->formFactory = $formFactory;
		$this->updateTrickTypeHandler = $updateTrickTypeHandler;
		$this->tricksRepository = $tricksRepository;
	}
  
  /**
   * @Route("update/trick/{slug}", name="updateTrick")
   *
   * @param ResponderUpdateTrickInterface $responderUpdateTricks
   * @param Request                       $request
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

		$tricks = $this->tricksRepository->getBySlug($request->attributes->get('slug'));

		$dto = new UpdateTrickDTO(
			$tricks->getName(),
			$tricks->getDescription(),
			$tricks->getGroup(),
			$tricks->getPictures()->toArray(),
			$tricks->getMovies()->toArray()
		);

		$updateTrickType = $this->formFactory
			->create(UpdateTrickType::class, $dto)
			->handleRequest($request);

		if ($this->updateTrickTypeHandler->handle($updateTrickType, $tricks)){
			return $responderUpdateTricks(true);
		}

		return $responderUpdateTricks(false,[
			'tricks' => $tricks,
			'form' => $updateTrickType->createView()
		], $updateTrickType);
	}
}
