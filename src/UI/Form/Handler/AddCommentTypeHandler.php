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
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Picture;
use App\Domain\Models\Users;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddCommentTypeHandlerInterface;
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
     * @var CommentRepositoryInterface
     */
    private $commentRepository;

	/**
	 * @var TokenStorageInterface
	 */
	private $tokenStorage;
  
  /**
   * AddCommentTypeHandler constructor.
   *
   * @param CommentFactoryInterface    $commentFactory
   * @param CommentRepositoryInterface $commentRepository
   * @param TokenStorageInterface      $tokenStorage
   */
	public function __construct(
      CommentFactoryInterface $commentFactory,
      CommentRepositoryInterface $commentRepository,
      TokenStorageInterface $tokenStorage
    ) {
        $this->commentFactory = $commentFactory;
        $this->commentRepository = $commentRepository;
		$this->tokenStorage = $tokenStorage;
	}
  
  /**
   * @param FormInterface  $form
   * @param TrickInterface $trick
   *
   * @return bool
   * @throws \Exception
   */
    public function handle(
      FormInterface $form,
      TrickInterface $trick
    ):  bool {

        if ($form->isSubmitted() && $form->isValid()){
           $comment = $this->commentFactory->create(
            	$form->getData()->content,
				$trick,
              is_object($this->tokenStorage->getToken()->getUser()) ? $this->tokenStorage->getToken()->getUser(): new Users('', '', '', '', '', '')
			);

            $this->commentRepository->save($comment);

            return true;
        }
        return false;
    }
}
