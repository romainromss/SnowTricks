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

use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;

/**
 * Interfaces PicturesRepositoryInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface PicturesRepositoryInterface
{
	/**
	 * @param bool $first
	 *
	 * @return mixed
	 */
	public function getPicturesFirst(bool $first = false);


  /**
   * @param $slug
   *
   * @return mixed
   */
  public function getPictureByTrickSlugAndFirst($slug);

  /**
   * @param $id
   *
   * @return mixed
   */
	public function getPicturesById($id);

  /**
   * @param string $id
   *
   * @return void
   */
	public function deletePictures(string $id);

  /**
   * @return void
   */
	public function flush();
}