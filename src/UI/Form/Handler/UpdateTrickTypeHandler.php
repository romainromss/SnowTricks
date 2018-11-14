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

use App\Domain\Factory\Interfaces\MoviesFactoryInterface;
use App\Domain\Factory\Interfaces\PictureFactoryInterface;
use App\Domain\Factory\Interfaces\TrickFactoryInterface;
use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Movies;
use App\Domain\Models\Pictures;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\Infra\Helper\Interfaces\UploaderHelperInterface;
use App\Infra\Helper\UploaderHelper;
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
   * @var TricksRepositoryInterface
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
   * @var MoviesFactoryInterface
   */
  private $moviesFactory;
  
  /**
   * {@inheritdoc}
   */
  public function __construct(
    PictureFactoryInterface $pictureFactory,
    MoviesFactoryInterface $moviesFactory,
    TricksRepositoryInterface $tricksRepository,
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
   * @param FormInterface   $form
   * @param TricksInterface $tricks
   *
   * @return bool
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function handle(
    FormInterface $form,
    TricksInterface $tricks
  ):  bool
  {
    if ($form->isSubmitted() && $form->isValid()){
      $pictures = [];
      foreach($form->getData()->pictures as $picture) {
        if(\is_a($picture, PicturesInterface::class ) || is_null($picture->file))  {
          continue;
        }
        $fileName = $this->uploaderHelper->upload($picture->file);
        $pictures[] = $this->pictureFactory->create($fileName, $picture->legend, $picture->first);
      }
      
      $existPictures = $tricks->getPictures();
      dump($tricks->removePictures($existPictures));
  
      foreach($form->getData()->movies as $movie) {
        if(\is_a($movie, MoviesInterface::class ) || is_null($movie->embed))  {
          continue;
        }
        $movies[] = $this->moviesFactory->create($movie->embed, $movie->legend);
      }
      
        $tricks->addPictures($pictures);
      
      foreach($movies as $movie) {
        $tricks->addMovies($movie);
      }
      $this->tricksRepository->save($tricks);
  
      return true;
    }
    return false;
  }
}
