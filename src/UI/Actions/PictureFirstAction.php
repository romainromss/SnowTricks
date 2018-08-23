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

use App\Domain\Repository\Interfaces\PicturesRepositoryInterface;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Responder\Interfaces\ResponderFirstPictureInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PictureFirstAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PictureFirstAction
{
  /**
   * @var PicturesRepositoryInterface
   */
  private $picturesRepository;
  /**
   * @var TricksRepositoryInterface
   */
  private $tricksRepository;
  
  /**
   * PictureFirstAction constructor.
   *
   * @param PicturesRepositoryInterface $picturesRepository
   * @param TricksRepositoryInterface   $tricksRepository
   */
  public function __construct (
    PicturesRepositoryInterface $picturesRepository,
    TricksRepositoryInterface $tricksRepository
  ) {
    $this->picturesRepository = $picturesRepository;
    $this->tricksRepository = $tricksRepository;
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
    $trick = $this->tricksRepository->getBySlugWithPicturesId($request->attributes->get('slug'), $idPicture);
    
    foreach($trick->getPictures() as $picture) {
      $picture->getId()->toString() == $idPicture ? $picture->addFirst(true) : $picture->addFirst(false);
    }
    
    $this->picturesRepository->flush();
    
    return $responderFirstPicture($request);
  }
}
