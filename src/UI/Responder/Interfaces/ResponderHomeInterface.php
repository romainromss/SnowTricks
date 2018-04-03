<?php

namespace App\UI\Responder\Interfaces;

use App\Repository\TricksRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface ResponderHomeInterface
{
    /**
     * ResponderHomeInterface constructor.
     *
     * @param TricksRepository $tricksRepository
     * @param Environment $twig
     */
    public function __construct(TricksRepository $tricksRepository, Environment $twig);

    /**
     * @return Response
     */
    public function __invoke():Response;
}
