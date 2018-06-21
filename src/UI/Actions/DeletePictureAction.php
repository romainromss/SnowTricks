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
  use App\UI\Responder\Interfaces\ResponderDeletePictureInterface;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;

  /**
   * Class DeletePicture.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class DeletePictureAction
  {
    /**
     * @var PicturesRepositoryInterface
     */
    private $picturesRepository;

    /**
     * DeletePictureAction constructor.
     *
     * @param PicturesRepositoryInterface $picturesRepository
     */
    public function __construct (PicturesRepositoryInterface $picturesRepository)
      {
        $this -> picturesRepository = $picturesRepository;
      }

    /**
     * @Route("/delete/picture/{id}", name="deletePicture")
     *
     * @param ResponderDeletePictureInterface $responderDeletePicture
     * @param Request                $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
      public function __invoke (
       ResponderDeletePictureInterface $responderDeletePicture,
       Request $request
      ) {
        $this->picturesRepository->deletePictures($request->get('id'));

        return $responderDeletePicture();
      }
  }
