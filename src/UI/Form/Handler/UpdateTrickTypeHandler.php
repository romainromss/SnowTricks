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

use App\Domain\Factory\Interfaces\PictureFactoryInterface;
use App\Domain\Factory\Interfaces\TrickFactoryInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
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
   * {@inheritdoc}
   */
  public function __construct(
    PictureFactoryInterface $pictureFactory,
    TricksRepositoryInterface $tricksRepository,
    TokenStorageInterface $tokenStorage,
    UploaderHelperInterface $uploaderHelper
  ) {
    $this->tricksRepository = $tricksRepository;
    $this->tokenStorage = $tokenStorage;
    $this->pictureFactory = $pictureFactory;
    $this->uploaderHelper = $uploaderHelper;
  }
  
  /**
   * {@inheritdoc}
   *
   * @param FormInterface   $form
   * @param TricksInterface $tricks
   *
   * @return bool
   */
  public function handle(
    FormInterface $form,
    TricksInterface $tricks
  ):  bool
  {
    if ($form->isSubmitted() && $form->isValid()){
      foreach($form->getData()->pictures as $picture) {
        if(\is_a($picture, PicturesInterface::class)) {
          continue;
        }
        $fileName = $this->uploaderHelper->upload($picture->file);
        $pictures[] = $this->pictureFactory->create($fileName, $picture->legend, $picture->first);
      }
      $this->tricksRepository->update();
      
      return true;
    }
    return false;
  }
}
