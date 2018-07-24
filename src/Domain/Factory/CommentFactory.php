<?php

declare(strict_types=1);

/*
 * This file is part of the ${project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Factory;

use App\Domain\Factory\Interfaces\CommentBuilderInterface;
use App\Domain\Models\Comments;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Interfaces\UsersInterface;

/**
 * Class CommentBuilder.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentBuilder implements CommentBuilderInterface
{
    /**
     * @var Comments
     */
    private $comment;

    /**
     * @param string           $content
     * @param TricksInterface  $tricks
     * @param UsersInterface   $users
     *
     * @return CommentBuilder
     */
    public function create(
        string $content,
        TricksInterface $tricks,
        UsersInterface $users
    ):  self {

        $this->comment = new Comments($content, $tricks, $users);
        return $this;
    }

    /**
     * @return Comments
     */
    public function getComment(): Comments
    {
      return $this->comment;
    }
}
