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
use App\UI\Form\Handler\Interfaces\AddCommentTypeHandlerInterface;
use App\UI\Form\Type\AddCommentType;
use App\UI\Responder\Interfaces\ResponderTrickDetailsInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TrickDetailsAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TrickDetailsAction
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddCommentTypeHandlerInterface
     */
    private $addCommentTypeHandler;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * TrickDetailsAction constructor.
     *
     * @param FormFactoryInterface           $formFactory
     * @param AddCommentTypeHandlerInterface $addCommentTypeHandler
     * @param TrickRepositoryInterface       $trickRepository
     */
    public function __construct(
      FormFactoryInterface $formFactory,
      AddCommentTypeHandlerInterface $addCommentTypeHandler,
      TrickRepositoryInterface $trickRepository
    ) {
        $this->formFactory = $formFactory;
        $this->addCommentTypeHandler = $addCommentTypeHandler;
        $this->trickRepository = $trickRepository;
    }

    /**
     * @Route("/trick/{slug}", name="TricksDetails")
     *
     * @param ResponderTrickDetailsInterface $responderTricksDetails
     * @param Request                        $request
     *
     * @return Response
     *
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __invoke(
		ResponderTrickDetailsInterface $responderTricksDetails,
		Request $request
    ):  Response {

        $trick = $this->trickRepository->getBySlug($request->attributes->get('slug'));

        $addCommentType = $this->formFactory
            ->create(AddCommentType::class)
            ->handleRequest($request);

        if ($this->addCommentTypeHandler->handle($addCommentType, $trick)){
            return $responderTricksDetails(true);
        }

        return $responderTricksDetails(false,[
            'trick' => $trick,
            'form' => $addCommentType->createView()
        ],  $addCommentType);
    }
}
