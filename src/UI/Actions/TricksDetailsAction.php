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
use App\UI\Form\Handler\Intefaces\AddCommentTypeHandlerInterface;
use App\UI\Form\Type\AddCommentType;
use App\UI\Responder\Interfaces\ResponderTricksDetailsInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TricksDetailsAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TricksDetailsAction
{
    /**
     * @Route("/tricks/{slug}", name="TricksDetails")
     *
     * @param ResponderTricksDetailsInterface   $responderTricksDetails
     * @param TricksRepositoryInterface         $tricksRepository
     * @param string                            $slug
     * @param FormFactoryInterface              $formFactory
     * @param Request                           $request
     * @param AddCommentTypeHandlerInterface    $addCommentTypeHandler
     *
     * @return Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __invoke(
        ResponderTricksDetailsInterface $responderTricksDetails,
        TricksRepositoryInterface $tricksRepository,
        string $slug,
        FormFactoryInterface $formFactory,
        Request $request,
        AddCommentTypeHandlerInterface $addCommentTypeHandler
    ):  Response {

        $tricks = $tricksRepository->getBySlug($slug);

        $addCommentType = $formFactory
            ->create(AddCommentType::class)
            ->handleRequest($request);

        if ($addCommentTypeHandler->handle($addCommentType, $tricks)){
            return $responderTricksDetails(true);
        }

        return $responderTricksDetails(false,[
            'tricks' => $tricks,
            'form' => $addCommentType->createView()
        ],  $addCommentType);
    }
}
