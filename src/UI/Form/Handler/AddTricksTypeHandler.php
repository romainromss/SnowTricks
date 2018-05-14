<?php

declare(strict_types=1);

/*
 * This file is part of the snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Handler;

use App\Domain\Builder\TricksBuilder;
use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Form\Handler\Intefaces\AddTricksTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class AddTricksTypeHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTricksTypeHandler implements AddTricksTypeHandlerInterface
{
	/**
	 * @var TricksBuilder
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

	public function __construct(
		TricksBuilder $tricksBuilder,
		TricksRepositoryInterface $tricksRepository,
		TokenStorageInterface $tokenStorage
	) {

		$this->tricksBuilder = $tricksBuilder;
		$this->tricksRepository = $tricksRepository;
		$this->tokenStorage = $tokenStorage;
	}

	/**
	 * @param FormInterface      $form
	 *
	 * @return bool
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function handle(
		FormInterface $form
	):  bool {

		if ($form->isSubmitted() && $form->isValid()){
			$this->tricksBuilder->create(
				$form->getData()->name,
				$form->getData()->description,
				$form->getData()->group,
				$form->getData()->slug,
				$form->getData()->pictures,
				$form->getData()->movies,
				$this->tokenStorage->getToken()->getUser()
			);
			$this->tricksRepository->save($this->tricksBuilder->getTricks());
			return true;
		}
		return false;
	}
}