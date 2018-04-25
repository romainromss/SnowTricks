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

use App\Domain\Builder\Interfaces\CommentBuilderInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Repository\Interfaces\CommentsRepositoryInterface;
use App\UI\Form\Handler\Intefaces\AddCommentTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class AddCommentTypeHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddCommentTypeHandler implements AddCommentTypeHandlerInterface
{
    /**
     * @var CommentBuilderInterface
     */
    private $commentBuilder;

    /**
     * @var CommentsRepositoryInterface
     */
    private $commentsRepository;

    public function __construct(
        CommentBuilderInterface $commentBuilder,
        CommentsRepositoryInterface $commentsRepository
    ) {

        $this->commentBuilder = $commentBuilder;
        $this->commentsRepository = $commentsRepository;
    }

    /**
     * @param FormInterface    $form
     * @param TricksInterface  $tricks
     *
     * @return bool
     *
     */
    public function handle(
        FormInterface $form,
        TricksInterface $tricks
    ):  bool {

        if ($form->isSubmitted() && $form->isValid()){
            $this->commentBuilder->create($form->getData()->content, $tricks ); //token storage
            $this->commentsRepository->save($this->commentBuilder->getComment());
            return true;
        }
        return false;
    }
}
