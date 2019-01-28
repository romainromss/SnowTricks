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

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\ResponderHomeInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class ResponderHome.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderHome implements ResponderHomeInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ResponderHome constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
	{
        $this->twig = $twig;
    }

    /**
     * @param $data
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($data):Response
    {
        return new Response($this->twig->render('tricks/tricks.html.twig', $data));
    }
}
