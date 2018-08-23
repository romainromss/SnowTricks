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
use App\UI\Responder\Interfaces\ResponderTrickDetailsInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @var TricksRepositoryInterface
     */
    private $tricksRepository;

    /**
     * TrickDetailsAction constructor.
     *
     * @param FormFactoryInterface             $formFactory
     * @param AddCommentTypeHandlerInterface   $addCommentTypeHandler
     * @param TricksRepositoryInterface        $tricksRepository
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddCommentTypeHandlerInterface $addCommentTypeHandler,
        TricksRepositoryInterface $tricksRepository
    ) {
        $this->formFactory = $formFactory;
        $this->addCommentTypeHandler = $addCommentTypeHandler;
        $this->tricksRepository = $tricksRepository;
    }

    /**
     * @Route("/tricks/{slug}", name="TricksDetails")
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

        $tricks = $this->tricksRepository->getBySlug($request->attributes->get('slug'));

        $addCommentType = $this->formFactory
            ->create(AddCommentType::class)
            ->handleRequest($request);

        if ($this->addCommentTypeHandler->handle($addCommentType, $tricks)){
            return $responderTricksDetails(true);
        }

        return $responderTricksDetails(false,[
            'tricks' => $tricks,
            'form' => $addCommentType->createView()
        ],  $addCommentType);
    }
}
