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

namespace App\UI\Form\Handler;

use App\Domain\Factory\Interfaces\MovieFactoryInterface;
use App\Domain\Factory\Interfaces\PictureFactoryInterface;
use App\Domain\Models\Interfaces\MovieInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\Infra\Helper\Interfaces\UploaderHelperInterface;
use App\UI\Form\Handler\Interfaces\UpdateTrickTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UpdateTrickTypeHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickTypeHandler implements UpdateTrickTypeHandlerInterface
{
  /**
   * @var TrickRepositoryInterface
   */
  private $tricksRepository;
  
  /**
   * @var TokenStorageInterface
   */
  private $tokenStorage;
  /**
   * @var PictureFactoryInterface
   */
  private $pictureFactory;
  /**
   * @var UploaderHelperInterface
   */
  private $uploaderHelper;
  /**
   * @var MovieFactoryInterface
   */
  private $moviesFactory;
  
  /**
   * {@inheritdoc}
   */
  public function __construct(
    PictureFactoryInterface $pictureFactory,
    MovieFactoryInterface $moviesFactory,
    TrickRepositoryInterface $tricksRepository,
    TokenStorageInterface $tokenStorage,
    UploaderHelperInterface $uploaderHelper
  ) {
    $this->tricksRepository = $tricksRepository;
    $this->tokenStorage = $tokenStorage;
    $this->pictureFactory = $pictureFactory;
    $this->uploaderHelper = $uploaderHelper;
    $this->moviesFactory = $moviesFactory;
  }
  
  /**
   * @param FormInterface  $form
   * @param TrickInterface $tricks
   *
   * @return bool
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function handle(
    FormInterface $form,
    TrickInterface $tricks
  ):  bool
  {
    if ($form->isSubmitted() && $form->isValid()){
      $movies = [];
      $pictures = [];
      
      foreach($form->getData()->pictures as $picture) {
        $fileName = $this->uploaderHelper->upload($picture->file);
        $pictures[] = $this->pictureFactory->create($fileName, $picture->legend, $picture->first);
      }
      $existPictures = $tricks->getPictures();
      $tricks->removePictures($existPictures);
      foreach($pictures as $picture) {
        $tricks->addPictures($picture);
      }
  
      foreach($form->getData()->movies as $movie) {
        if(\is_a($movie, MovieInterface::class ) || is_null($movie->embed))  {
          continue;
        }
        $movies[] = $this->moviesFactory->create($movie->embed, $movie->legend);
      }
      foreach($movies as $movie) {
        $tricks->addMovies($movie);
      }
      
      $this->tricksRepository->update($tricks);
      return true;
    }
    return false;
  }
}
