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
use App\Domain\Repository\PicturesRepository;
use App\UI\Responder\Interfaces\ResponderDeleteTrickInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeleteTrickAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class DeleteTrickAction
{
	/**
	 * @var TricksRepositoryInterface
	 */
	private $tricksRepository;
  
  /**
	 * DeleteTrickAction constructor.
	 *
	 * @param TricksRepositoryInterface $tricksRepository
	 */
	public function __construct(TricksRepositoryInterface $tricksRepository)
	{
		$this->tricksRepository = $tricksRepository;
    }


	/**
	 * @Route("/delete/{slug}", name="deleteTrick")
	 *
	 * @param ResponderDeleteTrickInterface  $responderDeleteTrick
	 * @param Request                        $request
	 *
	 * @return RedirectResponse
	 *
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function __invoke(
		ResponderDeleteTrickInterface $responderDeleteTrick,
		Request $request
	) {
	  $this->tricksRepository->deleteTrick($request->attributes->get('slug'));
	  
		return $responderDeleteTrick();
	}
}
