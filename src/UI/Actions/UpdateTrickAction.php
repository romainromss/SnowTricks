<?php

declare(strict_types=1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Actions;

use App\Domain\DTO\MovieDTO;
use App\Domain\DTO\PictureDTO;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\Infra\Helper\UploaderHelper;
use App\UI\Form\Handler\UpdateTrickTypeHandler;
use App\UI\Form\Type\UpdateTrickType;
use App\UI\Responder\Interfaces\ResponderUpdateTrickInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateTricksAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickAction
{
  /**
   * @var FormFactoryInterface
   */
  private $formFactory;
  
  /**
   * @var UpdateTrickTypeHandler
   */
  private $updateTrickTypeHandler;
  
  /**
   * @var TrickRepositoryInterface
   */
  private $trickRepository;
  /**
   * @var string
   */
  private $imageFolder;
  
  /**
   * UpdateTrickAction constructor.
   *
   * @param FormFactoryInterface     $formFactory
   * @param UpdateTrickTypeHandler   $updateTrickTypeHandler
   * @param TrickRepositoryInterface $trickRepository
   * @param string                   $imageFolder
   */
  public function __construct(
    FormFactoryInterface $formFactory,
    UpdateTrickTypeHandler $updateTrickTypeHandler,
    TrickRepositoryInterface $trickRepository,
    string $imageFolder
    
  ) {
    $this->formFactory = $formFactory;
    $this->updateTrickTypeHandler = $updateTrickTypeHandler;
    $this->trickRepository = $trickRepository;
    $this->imageFolder = $imageFolder;
  }
  
  /**
   * @Route("update/trick/{slug}", name="updateTrick")
   *
   * @param ResponderUpdateTrickInterface $responderUpdateTricks
   * @param Request                       $request
   *
   * @return Response
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function __invoke(
    ResponderUpdateTrickInterface $responderUpdateTricks,
    Request $request
  ):  Response {
    
    $trick = $this->trickRepository->getBySlug($request->attributes->get('slug'));

    foreach($trick->getPictures()->toArray() as $picture) {
      $fileName = new UploadedFile($this->imageFolder.$picture->getName(), $picture->getName());
      $pictureDTO[] = new PictureDTO($fileName, $picture->getLegend(), $picture->isFirst());
    }
    foreach($trick->getMovies()->toArray() as $movie) {
      $movieDTO[] = new MovieDTO($movie->getEmbed(), $movie->getLegend());
    }
    
    $dto = new UpdateTrickDTO(
      $trick->getName(),
      $trick->getDescription(),
      $trick->getGroup(),
      $pictureDTO,
      $movieDTO
    );
    
    $updateTrickType = $this->formFactory
      ->create(UpdateTrickType::class, $dto)
      ->handleRequest($request);
    
    if ($this->updateTrickTypeHandler->handle($updateTrickType, $trick)){
      return $responderUpdateTricks(true);
    }
    
    return $responderUpdateTricks(false,[
      'trick' => $trick,
      'form' => $updateTrickType->createView()
    ], $updateTrickType);
  }
}
