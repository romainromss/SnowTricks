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

namespace App\UI\Responder;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class LoginResponder.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class LoginResponder
{
  /** @var Environment */
  private $twig;
  
  /**
   *{@inheritdoc}
   */
  public function __construct(Environment $twig)
  {
    $this->twig = $twig;
  }
  
  /**
   * {@inheritdoc}
   */
  public function __invoke($data)
  {
    return new Response(
      $this->twig->render('Login/login.html.twig', $data)
    );
  }
}
