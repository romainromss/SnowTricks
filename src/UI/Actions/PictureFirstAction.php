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

namespace App\UI\Actions;

use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Responder\Interfaces\ResponderFirstPictureInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PictureFirstAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PictureFirstAction
{
  /**
   * @var PictureRepositoryInterface
   */
  private $pictureRepository;
  /**
   * @var TrickRepositoryInterface
   */
  private $trickRepository;
  
  /**
   * PictureFirstAction constructor.
   *
   * @param PictureRepositoryInterface $pictureRepository
   * @param TrickRepositoryInterface   $trickRepository
   */
  public function __construct (
    PictureRepositoryInterface $pictureRepository,
    TrickRepositoryInterface $trickRepository
  ) {
    $this->pictureRepository = $pictureRepository;
    $this->trickRepository = $trickRepository;
  }
  
  /**
   * @Route("/tricks/{slug}/picture-first/{id}", name="pictureFirst")
   *
   * @param Request                        $request
   * @param ResponderFirstPictureInterface $responderFirstPicture
   *
   * @return RedirectResponse
   */
  public function __invoke (
    Request $request,
    ResponderFirstPictureInterface $responderFirstPicture
  ) {
    $idPicture = $request->attributes->get('id');
    $trick = $this->trickRepository->getBySlugWithPicturesId($request->attributes->get('slug'), $idPicture);
    
    foreach($trick->getPictures() as $picture) {
      $picture->getId()->toString() == $idPicture ? $picture->addFirst(true) : $picture->addFirst(false);
    }
    
    $this->pictureRepository->flush();
    
    return $responderFirstPicture($request);
  }
}
