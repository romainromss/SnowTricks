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

namespace App\Domain\Repository\Interfaces;

use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Trick;

/**
 * Interfaces TrickRepositoryInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface TrickRepositoryInterface
{
  /**
   * @param bool $first
   *
   * @return mixed
   */
  public function getAllWithPictures(bool $first = false);
  
  public function getBySlugWithPicturesId($slug, $id);
  
  /**
   * @param $slug
   *
   * @return mixed
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getBySlug($slug);
  
  /**
   * @param $tricks
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function save($tricks);
  
  /**
   * @return void
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function update($tricks);
  
  /**
   * @param string $slug
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function deleteTrick(string $slug);
  
}
