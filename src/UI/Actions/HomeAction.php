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
     * @Route("/", name="index")
     *
     * @param ResponderHomeInterface $responderHome
     * @param TricksRepositoryInterface $tricksRepository
     *
     * @return Response
     */
    public function __invoke(
        ResponderHomeInterface $responderHome,
        TricksRepositoryInterface $tricksRepository
    ):  Response {

        return $responderHome(['tricks' => $tricksRepository->getAllWithPictures(true)]);
    }
}

