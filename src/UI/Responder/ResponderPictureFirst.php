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

  use App\UI\Responder\Interfaces\ResponderFirstPictureInterface;
  use Symfony\Component\HttpFoundation\RedirectResponse;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
  use Symfony\Component\Routing\Router;

  /**
   * Class ResponderFirstAction.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class ResponderPictureFirst implements ResponderFirstPictureInterface
  {
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * ResponderFirstAction constructor.
     *
     * @param UrlGeneratorInterface  $urlGenerator
     */
    public function __construct (UrlGeneratorInterface $urlGenerator)
    {
      $this -> urlGenerator = $urlGenerator;
    }

    /**
     *{@inheritdoc}
     */
    public function __invoke (Request $request)
    {
      $slug = $request->attributes->get ('slug');

      return new RedirectResponse($this->urlGenerator->generate ('TricksDetails', [
       'slug' => $slug
      ]));
    }
  }
