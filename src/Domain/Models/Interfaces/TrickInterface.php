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
   * @return UserInterface
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
   * @param PictureInterface $pictures
   */
  public function unsetPictures(PictureInterface $pictures): void;
  
  /**
   * @param array $picture
   *
   * @return mixed
   */
  public function removePictures(\ArrayAccess $picture);
  
  /**
   * @param array
   *
   * @return mixed
   */
  public function addMovies(array $movies);
  
  
  /**
   * @param $movies
   */
  public function unsetMovies(MovieInterface $movies): void;
  
  /**
   * @param $comments
   *
   * @return mixed
   */
  public function addComments(CommentInterface $comments): void;
  
  
  /**
   * @param $comments
   */
  public function unsetComment(CommentInterface $comments): void;
}
