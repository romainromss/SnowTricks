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

use App\Domain\Factory\Interfaces\TrickFactoryInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Form\Handler\Intefaces\UpdateTrickTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UpdateTrickTypeHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickTypeHandler implements UpdateTrickTypeHandlerInterface
{
	/**
	 * @var TrickFactoryInterface
	 */
	private $trickFactory;

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
      TrickFactoryInterface $trickFactory,
      TricksRepositoryInterface $tricksRepository,
      TokenStorageInterface $tokenStorage
	) {
		$this->trickFactory = $trickFactory;
		$this->tricksRepository = $tricksRepository;
		$this->tokenStorage = $tokenStorage;
	}
  
  /**
   * {@inheritdoc}
   *
   * @param FormInterface   $form
   * @param TricksInterface $tricks
   *
   * @return bool
   */
	public function handle(
	  FormInterface $form,
      TricksInterface $tricks
):  bool
	{
		if ($form->isSubmitted() && $form->isValid()){
			$this->trickFactory->create(
				$form->getData()->name,
				$form->getData()->description,
				$form->getData()->category,
				$this->tokenStorage->getToken()->getUser(),
				$form->getData()->pictures,
				$form->getData()->movies
			);

			$this->tricksRepository->update();

			return true;
		}
		return false;
	}
}
