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

use App\Domain\Factory\Interfaces\CommentFactoryInterface;
use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\CommentInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UserInterface;

/**
 * Class CommentBuilder.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentFactory implements CommentFactoryInterface
{
  /**
   * @param string         $content
   * @param TrickInterface $trick
   * @param UserInterface  $user
   *
   * @return CommentInterface
   * @throws \Exception
   */
    public function create(
      string $content,
      TrickInterface $trick,
      UserInterface $user
    ): CommentInterface {

         return new Comment($content, $trick, $user);
    }
}
