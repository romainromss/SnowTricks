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

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ResponderForgotPassword.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderForgotPassword
{
  /** @var Environment */
  private $twig;
  
  /** @var UrlGeneratorInterface  */
  private $urlGenerator;
  
  public function __construct(
    Environment $twig,
    UrlGeneratorInterface $urlGenerator
  ) {
    $this->twig = $twig;
    $this->urlGenerator = $urlGenerator;
  }
  
  /**
   * @param bool               $redirect
   * @param                    $data
   *
   * @param FormInterface|null $forgotPasswordType
   *
   * @return Response
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function __invoke(
    $redirect = false,
    $data = null,
    FormInterface $forgotPasswordType = null
  ):  Response {
    
    $response = $redirect
      ?  new RedirectResponse($this->urlGenerator->generate('index'))
      :  new Response($this->twig->render('Forgot/ForgotPassword.html.twig', $data));
    return $response;
  }
}
