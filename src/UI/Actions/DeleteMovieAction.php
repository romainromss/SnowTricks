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

  use App\Domain\Repository\Interfaces\MoviesRepositoryInterface;
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
     * @var MoviesRepositoryInterface
     */
    private $moviesRepository;

    public  function __construct(MoviesRepositoryInterface $moviesRepository)
    {
      $this->moviesRepository = $moviesRepository;
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
      $this->moviesRepository->deleteMovies($request->get('id'));

      return $responderDeleteMovie();
    }
  }
