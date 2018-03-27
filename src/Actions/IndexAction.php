<?php

namespace App\Actions;

use App\Responder\Interfaces\ResponderHomeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Responder\ResponderHome;

class IndexAction
{
    /**
     * @var ResponderHome
     */
    private $responderHome;

    /**
     * IndexAction constructor.
     *
     * @param ResponderHomeInterface $responderHomeInterface
     */
    public function __construct(ResponderHomeInterface $responderHomeInterface)
    {
        $this->responderHome = $responderHomeInterface;
    }

    /**
     * @Route("/", name="index")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $responder = $this->responderHome;
        return $responder();
    }
}
