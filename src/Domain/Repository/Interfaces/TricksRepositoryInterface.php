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

/**
 * Interface TricksRepositoryInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface TricksRepositoryInterface
{
    /**
     * @param bool $first
     *
     * @return mixed
     */
    public function getAllWithPictures(bool $first = false);

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
	 * @param $tricks
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function flush($tricks);

	/**
	 * @param $id
	 *
	 * @return void
	 */
	public function deleteTrick($id);
}
