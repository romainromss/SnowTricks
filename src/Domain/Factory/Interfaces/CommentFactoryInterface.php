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

namespace App\Domain\Factory\Interfaces;

use App\Domain\Factory\CommentFactory;
use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\CommentInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UsersInterface;

/**
 * Interfaces CommentBuilderInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface CommentFactoryInterface
{
  /**
   * @param string         $content
   * @param TrickInterface $tricks
   * @param UsersInterface $users
   *
   * @return CommentInterface
   */
    public function create(
      string $content,
      TrickInterface $tricks,
      UsersInterface $users
    ):  CommentInterface;
}
