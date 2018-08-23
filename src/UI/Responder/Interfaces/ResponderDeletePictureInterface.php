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

  namespace App\UI\Responder\Interfaces;

  use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
  use Symfony\Component\HttpFoundation\RedirectResponse;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

  /**
   * Interface ResponderDeletePictureInterface
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
 interface ResponderDeletePictureInterface
 {
   /**
    * ResponderDeletePicture constructor.
    *
    * @param UrlGeneratorInterface      $urlGenerator
    */
   public function __construct (UrlGeneratorInterface $urlGenerator);

   /**
    *
    * @return RedirectResponse
    */
   public function __invoke();
 }
