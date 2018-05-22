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

namespace App\UI\Form\Handler;

use App\Domain\Builder\Interfaces\TrickBuilderInterface;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UpdateTrickTypeHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickTypeHandler
{
	/**
	 * @var TrickBuilderInterface
	 */
	private $tricksBuilder;

	/**
	 * @var TricksRepositoryInterface
	 */
	private $tricksRepository;

	/**
	 * @var TokenStorageInterface
	 */
	private $tokenStorage;


	/**
	 * {@inheritdoc}
	 */
	public function __construct(
		TrickBuilderInterface $tricksBuilder,
		TricksRepositoryInterface $tricksRepository,
		TokenStorageInterface $tokenStorage
	) {
		$this->tricksBuilder = $tricksBuilder;
		$this->tricksRepository = $tricksRepository;
		$this->tokenStorage = $tokenStorage;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function handle(FormInterface $form):  bool
	{
		if ($form->isSubmitted() && $form->isValid()){
			$this->tricksBuilder->create(
				$form->getData()->name,
				$form->getData()->description,
				$form->getData()->group,
				$form->getData()->slug,
				$this->tokenStorage->getToken()->getUser(),
				$form->getData()->pictures,
				$form->getData()->movies
			);

			$this->tricksRepository->flush($this->tricksBuilder->getTrick());

			return true;
		}
		return false;
	}
}
