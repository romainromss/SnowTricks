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

  namespace App\Domain\Repository\Interfaces;


  use App\Domain\Models\Interfaces\MoviesInterface;

  interface MoviesRepositoryInterface
  {
    /**
     * @param $id
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getMoviesByEmbed($id);

    /**
     * @param MoviesInterface $movies
     *
     * @return mixed
     */
    public function deleteMovies(MoviesInterface $movies);
  }