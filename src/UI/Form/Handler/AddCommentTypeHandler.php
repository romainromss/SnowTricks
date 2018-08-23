<?php

declare(strict_types=1);

/*
 * This file is part of the SnowTricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\UI\Form\Handler;

use App\Domain\Factory\Interfaces\CommentFactoryInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Pictures;
use App\Domain\Models\Users;
use App\Domain\Repository\Interfaces\CommentsRepositoryInterface;
use App\UI\Form\Handler\Intefaces\AddCommentTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class AddCommentTypeHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddCommentTypeHandler implements AddCommentTypeHandlerInterface
{
    /**
     * @var CommentFactoryInterface
     */
    private $commentFactory;

    /**
     * @var CommentsRepositoryInterface
     */
    private $commentsRepository;

	/**
	 * @var TokenStorageInterface
	 */
	private $tokenStorage;

	public function __construct(
      CommentFactoryInterface $commentFactory,
      CommentsRepositoryInterface $commentsRepository,
      TokenStorageInterface $tokenStorage
    ) {
        $this->commentFactory = $commentFactory;
        $this->commentsRepository = $commentsRepository;
		$this->tokenStorage = $tokenStorage;
	}

	/**
	 * @param FormInterface    $form
	 * @param TricksInterface  $tricks
	 *
	 * @return bool
	 */
    public function handle(
        FormInterface $form,
		TricksInterface $tricks
    ):  bool {

        if ($form->isSubmitted() && $form->isValid()){
           $comment = $this->commentFactory->create(
            	$form->getData()->content,
				$tricks,
              is_object($this->tokenStorage->getToken()->getUser()) ? $this->tokenStorage->getToken()->getUser(): new Users('', '', '', '', '', '')
			);

            $this->commentsRepository->save($comment);

            return true;
        }
        return false;
    }
}
