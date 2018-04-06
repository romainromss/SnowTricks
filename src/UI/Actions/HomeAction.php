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

use App\Domain\Repository\TricksRepository;
use App\UI\Responder\Interfaces\ResponderHomeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAction
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class HomeAction
{
    /**
     * @Route("/", name="index")
     *
     * @param ResponderHomeInterface $responderHome
     *
     * @param TricksRepository $tricksRepository
     *
     * @return Response
     */
    public function __invoke(ResponderHomeInterface $responderHome, TricksRepository $tricksRepository): Response
    {
        return $responderHome(['tricks' => $tricksRepository->getAllWithPictures()]);
    }
}

