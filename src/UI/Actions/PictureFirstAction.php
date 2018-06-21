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
  use App\UI\Responder\Interfaces\ResponderFirstPictureInterface;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Symfony\Component\HttpFoundation\RedirectResponse;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
     * PictureFirstAction constructor.
     *
     * @param PicturesRepositoryInterface $picturesRepository
     */
    public function __construct (PicturesRepositoryInterface $picturesRepository)
    {
      $this -> picturesRepository = $picturesRepository;
    }

    /**
     * @Route("/tricks/{slug}/picture-first/{id}", name="pictureFirst")
     *
     * @param Request                         $request
     * @param ResponderFirstPictureInterface  $responderFirstPicture
     *
     * @return RedirectResponse
     */
    public function __invoke (
     Request $request,
     ResponderFirstPictureInterface $responderFirstPicture
    ) {
      $idPicture = $request->attributes->get('id');
      $slug = $request->attributes->get('slug');

      $pictures = $this->picturesRepository->getPictureByTrickSlugAndFirst ($slug);

        if ($pictures) {
          foreach ($pictures as $picture) {
            if($picture->getId()->toString() == $idPicture) {
              $picture -> addFirst (true);

            }else{
              $picture->addFirst (false);
            }
        }
      }
        $this->picturesRepository->flush();

        return $responderFirstPicture($request);
    }
  }
