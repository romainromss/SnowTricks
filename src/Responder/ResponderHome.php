<?php

namespace App\Responder;

use App\Repository\TricksRepository;
use App\Responder\Interfaces\ResponderHomeInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ResponderHome implements ResponderHomeInterface
{
    /**
     * @var TricksRepository
     */
    private $tricksRepository;
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ResponderHome constructor.
     *
     * @param TricksRepository $tricksRepository
     * @param Environment $twig
     */
    public function __construct(
        TricksRepository $tricksRepository,
        Environment $twig
    ) {
        $this->tricksRepository = $tricksRepository;
        $this->twig = $twig;
    }


    /**
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke()
    {
        return new Response($this->twig->render('tricksfail.html.twig', [
            'tricks' => $this->tricksRepository->getAllWithPictures()
        ]));
    }
}