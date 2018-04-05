<?php

namespace App\UI\Actions;

use App\UI\Responder\Interfaces\ResponderHomeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeAction
{
    /**
     * @Route("/", name="index")
     *
     * @param ResponderHomeInterface $responderHome
     *
     * @return Response
     */
    public function __invoke(ResponderHomeInterface $responderHome): Response
    {
        return $responderHome();
    }
}
