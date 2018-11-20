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

use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Responder\Interfaces\ResponderHomeInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
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
	 * @var TrickRepositoryInterface
	 */
	private $trickRepository;

	/**
	 * HomeAction constructor.
	 *
	 * @param TrickRepositoryInterface $trickRepository
	 */
	public function __construct(TrickRepositoryInterface $trickRepository)
	{
		$this->trickRepository = $trickRepository;
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
	 
		$trick = $this->trickRepository->getAllWithPictures(true);

		return $responderHome([
			'trick' => $trick
		]);
	}
}
