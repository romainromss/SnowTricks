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

namespace App\UI\Form\Handler\Interfaces;

use App\Domain\Factory\Interfaces\MovieFactoryInterface;
use App\Domain\Factory\Interfaces\PictureFactoryInterface;
use App\Domain\Factory\Interfaces\TrickFactoryInterface;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Movie;
use App\Domain\Models\Picture;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\Infra\Helper\Interfaces\UploaderHelperInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Interfaces UpdateTrickTypeHandlerInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface UpdateTrickTypeHandlerInterface
{
  /**
   * UpdateTrickTypeHandlerInterface constructor.
   *
   * @param PictureFactoryInterface  $pictureFactory
   * @param MovieFactoryInterface    $moviesFactory
   * @param TrickRepositoryInterface $tricksRepository
   * @param TokenStorageInterface    $tokenStorage
   * @param UploaderHelperInterface  $uploaderHelper
   */
	public function __construct(
      PictureFactoryInterface $pictureFactory,
      MovieFactoryInterface $moviesFactory,
      TrickRepositoryInterface $tricksRepository,
      TokenStorageInterface $tokenStorage,
      UploaderHelperInterface $uploaderHelper
    );
  
  /**
   * @param FormInterface  $form
   *
   * @param TrickInterface $tricks
   *
   * @return bool
   */
	public function handle(
      FormInterface $form,
      TrickInterface $tricks
    ):  bool;

}
