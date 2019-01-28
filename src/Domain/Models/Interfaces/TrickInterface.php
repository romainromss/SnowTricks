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

namespace App\Domain\Models\Interfaces;

use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Movie;
use App\Domain\Models\Picture;
use Ramsey\Uuid\UuidInterface;

/**
 * Interfaces TrickInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface TrickInterface
{
  /**
   * @return \ArrayAccess
   */
  public function getPictures();
  
  /**
   * @return \ArrayAccess
   */
  public function getComments();
  
  /**
   * @return UsersInterface
   */
  public function getUsers();
  
  /**
   * @return UuidInterface
   */
  public function getId(): UuidInterface;
  
  /**
   * @return string
   */
  public function getName(): string;
  
  /**
   * @return string
   */
  public function getDescription(): string;
  
  /**
   * @return string
   */
  public function getGroup(): string;
  
  /**
   * @return string
   */
  public function getUpdatedAt(): ? string;
  
  /**
   * @return mixed
   */
  public function getCreatedAt();
  
  /**
   * @return \ArrayAccess
   */
  public function getMovies();
  
  /**
   * @return string
   */
  public function getSlug(): string;
  
  /**
   * @param PictureInterface $pictures
   *
   * @return array
   */
  public function addPictures(PictureInterface $pictures);
  
  /**
   * @param Picture $picture
   *
   * @return mixed
   */
  public function removePicture(Picture $picture);
  
  /**
   * @param MovieInterface $movies
   *
   * @return mixed
   */
  public function addMovies(MovieInterface $movies);
  
  /**
   * @param Movie $movie
   *
   * @return mixed
   */
  public function removeMovie(Movie $movie);
  
  /**
   * @param $comments
   *
   * @return mixed
   */
  public function addComments(CommentInterface $comments): void;
  
  /**
   * @param UpdateTrickDTO $updateTrickDTO
   *
   * @return mixed
   */
  public function updateTrick(UpdateTrickDTO $updateTrickDTO);
}
