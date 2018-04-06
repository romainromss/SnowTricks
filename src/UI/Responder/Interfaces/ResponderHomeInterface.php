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

namespace App\UI\Responder\Interfaces;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Interface ResponderHomeInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface ResponderHomeInterface
{
    /**
     * ResponderHomeInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param $data
     *
     * @return Response
     */
    public function __invoke($data):Response;
}
