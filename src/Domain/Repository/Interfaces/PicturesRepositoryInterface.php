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
 * Interface PicturesRepositoryInterface
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
	public function getPicturesFirst(bool $first= false);

	/**
	 * @param $trick
	 *
	 * @return mixed
	 */
	public function getPicturesByTrickId($trick);

	/**
	 * @param PicturesInterface $pictures
	 *
	 * @return mixed
	 */
	public function deletePictures(PicturesInterface $pictures);
}