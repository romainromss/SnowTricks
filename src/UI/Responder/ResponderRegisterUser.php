<?php

declare(strict_types = 1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Responder;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class ResponderRegisterUser.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderRegisterUser
{
  /** @var Environment */
  private $twig;
  
  public function __construct(Environment $twig)
  {
    $this->twig = $twig;
  }
  
  /**
   * @param $data
   *
   * @return Response
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function __invoke($data)
  {
    return new Response(
      $this->twig->render('register.html.twig', $data)
    );
  }
}
