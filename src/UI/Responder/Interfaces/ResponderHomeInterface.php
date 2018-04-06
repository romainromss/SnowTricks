<?php
declare(strict_types=1);

namespace App\UI\Responder\Interfaces;

use App\Repository\TricksRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Interface ResponderHomeInterface
 *
 * @package App\UI\Responder\Interfaces
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
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
