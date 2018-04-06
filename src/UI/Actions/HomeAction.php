<?php
declare(strict_types=1);

namespace App\UI\Actions;

use App\UI\Responder\Interfaces\ResponderHomeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeAction
 *
 * @package App\UI\Actions
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
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

