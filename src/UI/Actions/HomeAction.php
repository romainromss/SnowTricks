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

use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Responder\Interfaces\ResponderHomeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class HomeAction
{
	/**
	 * @var TricksRepositoryInterface
	 */
	private $tricksRepository;

	/**
	 * HomeAction constructor.
	 *
	 * @param TricksRepositoryInterface $tricksRepository
	 */
	public function __construct(TricksRepositoryInterface $tricksRepository)
	{
		$this->tricksRepository = $tricksRepository;
	}

	/**
	 * @Route("/", name="index")
	 *
	 * @param ResponderHomeInterface $responderHome
	 *
	 * @return Response
	 */
	public function __invoke(
		ResponderHomeInterface $responderHome
	):  Response {

		$tricks = $this->tricksRepository->getAllWithPictures(true);

		return $responderHome([
			'tricks' => $tricks
		]);
	}
}
