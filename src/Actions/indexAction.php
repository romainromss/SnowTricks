<?php

namespace App\Actions;

use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class indexAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * TricksDetailsAction constructor.
     *
     * @param Environment            $twig
     * @param EntityManagerInterface $doctrine
     */
    public function __construct(
        Environment $twig,
        EntityManagerInterface $doctrine
    ) {
        $this->twig = $twig;
        $this->doctrine = $doctrine;
    }

    /**
     * @param Request          $request
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
        $page = intval($request->get('page'));
        $maxByPage = 9;

        if ($page < 1){
            return new RedirectResponse('/1');
        }

        $tricks = $tricksRepository->getAllWithPictures($page);
        $total = $tricks->count();
        $maxPage = ceil($total / $maxByPage);

        if ($page > $maxPage) {
            return new RedirectResponse('/1');
        }

        return new Response($this->twig->render('tricks/tricks.html.twig', [
            'tricks' => $tricks,
            'page' => $total,
            'nextpage' => $maxPage
        ]));
    }
}