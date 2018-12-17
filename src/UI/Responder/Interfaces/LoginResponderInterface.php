<?php

declare(strict_types = 1);

/*
 * This file is part of the snowtricks project.
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
 * Interface LoginResponderInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface LoginResponderInterface
{
  /**
   * LoginResponder constructor.
   *
   * @param Environment $twig
   */
  public function __construct(Environment $twig);
  
  /**
   * @param $data
   *
   * @return Response
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function render($data);
}
