<?php

declare(strict_types=1);

/*
 * This file is part of the snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Handler;

use App\Domain\Factory\Interfaces\MovieFactoryInterface;
use App\Domain\Factory\Interfaces\PictureFactoryInterface;
use App\Domain\Factory\Interfaces\TrickFactoryInterface;
use App\Domain\Models\Users;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\Infra\Helper\UploaderHelper;
use App\UI\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class AddTrickTypeHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickTypeHandler implements AddTrickTypeHandlerInterface
{
  /**
   * @var TrickFactoryInterface
   */
  private $trickFactory;
  
  /**
   * @var PictureFactoryInterface
   */
  private $pictureFactory;
  
  /**
   * @var MovieFactoryInterface
   */
  private $movieFactory;
  
  /**
   * @var TrickRepositoryInterface
   */
  private $trickRepository;
  
  /**
   * @var TokenStorageInterface
   */
  private $tokenStorage;
  
  /**
   * @var UploaderHelper
   */
  private $uploaderHelper;
  
  
  /**
   * AddTrickTypeHandler constructor.
   *
   * @param TrickFactoryInterface    $trickFactory
   * @param PictureFactoryInterface  $pictureFactory
   * @param MovieFactoryInterface    $movieFactory
   * @param TrickRepositoryInterface $trickRepository
   * @param TokenStorageInterface    $tokenStorage
   * @param UploaderHelper           $uploaderHelper
   */
  public function __construct(
    TrickFactoryInterface $trickFactory,
    PictureFactoryInterface $pictureFactory,
    MovieFactoryInterface $movieFactory,
    TrickRepositoryInterface $trickRepository,
    TokenStorageInterface $tokenStorage,
    UploaderHelper $uploaderHelper
  ) {
    $this->trickFactory = $trickFactory;
    $this->trickRepository = $trickRepository;
    $this->tokenStorage = $tokenStorage;
    $this->pictureFactory = $pictureFactory;
    $this->uploaderHelper = $uploaderHelper;
    $this->movieFactory = $movieFactory;
  }
  
  /**
   * @param FormInterface $form
   *
   * @return bool
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function handle(FormInterface $form):  bool
  {
    if ($form->isSubmitted() && $form->isValid()){
      if (\count($form->getData()->pictures) > 0) {
        $pictures = $this->pictureFactory->createFromArray($form->getData()->pictures);
      }
      
      if (\count($form->getData()->movies) > 0) {
          $movies = $this->movieFactory->createFromArray($form->getData()->movies);
      }
      $trick = $this->trickFactory->create(
        $form->getData()->name,
        $form->getData()->description,
        $form->getData()->category,
        $this->tokenStorage->getToken()->getUser(),
        $pictures ?? [],
        $movies ?? []
      );
      $this->trickRepository->save($trick);
      
      return true;
    }
    return false;
  }
}
