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

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ResponderRegisterValidation
{
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  public function __construct(UrlGeneratorInterface $urlGenerator)
  {
    $this->urlGenerator = $urlGenerator;
  }
  
  public function __invoke(): RedirectResponse
  {
    $response  = new RedirectResponse($this->urlGenerator->generate('index'));
    return $response;
  }
}
