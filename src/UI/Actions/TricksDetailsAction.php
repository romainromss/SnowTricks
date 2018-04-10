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
use App\UI\Responder\ResponderTricksDetails;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TricksDetailsAction
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TricksDetailsAction
{
    /**
     * @Route("/tricks/{slug}", name="TricksDetails")
     *
     * @param ResponderTricksDetails $responderTricksDetails
     * @param TricksRepository $tricksRepository
     * @param $slug
     *
     * @return Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ResponderTricksDetails $responderTricksDetails, TricksRepository $tricksRepository, $slug): Response
    {
        return $responderTricksDetails(['tricks' => $tricksRepository->getBySlug($slug)]);
    }
}