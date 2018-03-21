<?php

namespace App\Actions;

use App\Repository\TricksRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class IndexAction
{
    /**
     * @var Environment $twig
     */
    private $twig;

    /**
     * TricksDetailsAction constructor.
     *
     * @param Environment $twig
     */
    public function __construct(
        Environment $twig
    ) {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="index")
     *
     * @param Request $request
     * @param TricksRepository $tricksRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, TricksRepository $tricksRepository): Response
    {
        $tricks = $tricksRepository->getAllWithPictures();
        return new Response($this->twig->render('tricks/tricks.html.twig', [
            'tricks' => $tricks
        ]));
    }
}
