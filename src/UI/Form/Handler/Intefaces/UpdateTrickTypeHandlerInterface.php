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

namespace App\UI\Form\Handler\Intefaces;

use App\Domain\Builder\Interfaces\TrickBuilderInterface;
use App\Domain\DTO\UpdateTricksDTO;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Interface UpdateTrickTypeHandlerInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface UpdateTrickTypeHandlerInterface
{
	/**
	 * UpdateTrickTypeHandler constructor.
	 *
	 * @param TrickBuilderInterface     $tricksBuilder
	 * @param TricksRepositoryInterface $tricksRepository
	 * @param TokenStorageInterface     $tokenStorage
	 */
	public function __construct(
		TrickBuilderInterface $tricksBuilder,
		TricksRepositoryInterface $tricksRepository,
		TokenStorageInterface $tokenStorage
	);

	/**
	 * @param FormInterface      $form
	 *
	 * @return bool
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function handle(FormInterface $form):  bool;

}
