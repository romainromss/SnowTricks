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

  use App\Domain\Repository\Interfaces\MovieRepositoryInterface;
  use App\UI\Responder\Interfaces\ResponderDeleteMovieInterface;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;

  /**
   * Class DeleteMovieAction.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class DeleteMovieAction
  {
    /**
     * @var MovieRepositoryInterface
     */
    private $movieRepository;

    public  function __construct(MovieRepositoryInterface $movieRepository)
    {
      $this->movieRepository = $movieRepository;
    }

    /**
     * @Route("/delete/movie/{id}", name="deleteMovie")
     *
     * @param ResponderDeleteMovieInterface  $responderDeleteMovie
     * @param Request                        $request
     *
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __invoke (
     ResponderDeleteMovieInterface $responderDeleteMovie,
     Request $request
    ) {
      $this->movieRepository->deleteMovies($request->get('id'));

      return $responderDeleteMovie();
    }
  }
