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

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

/**
 * Interfaces TricksInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface TricksInterface
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
   * @param array $pictures
   *
   * @return array
   */
  public function addPictures(array $pictures);
  
  
  /**
   * @param PicturesInterface $pictures
   */
  public function unsetPictures(PicturesInterface $pictures): void;
  
  /**
   * @param array $picture
   *
   * @return mixed
   */
  public function removePictures(\ArrayAccess $picture);
  
  /**
   * @param $movies
   *
   * @return mixed
   */
  public function addMovies(MoviesInterface $movies);
  
  
  /**
   * @param $movies
   */
  public function unsetMovies(MoviesInterface $movies): void;
  
  /**
   * @param $comments
   *
   * @return mixed
   */
  public function addComments(CommentsInterface $comments): void;
  
  
  /**
   * @param $comments
   */
  public function unsetComment(CommentsInterface $comments): void;
}
