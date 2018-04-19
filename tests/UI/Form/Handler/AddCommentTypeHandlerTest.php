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

namespace App\Tests\UI\Form\Handler;

use App\Domain\Builder\Interfaces\CommentBuilderInterface;
use App\Domain\Repository\Interfaces\CommentsRepositoryInterface;
use App\UI\Form\Handler\AddCommentTypeHandler;
use PHPUnit\Framework\TestCase;

class AddCommentTypeHandlerTest extends TestCase
{
    public function testConstruct()
    {
        $commentBuilder = $this->createMock(CommentBuilderInterface::class);
        $commentRepositoy = $this->createMock(CommentsRepositoryInterface::class);

        $addCommentTypeHandler = new AddCommentTypeHandler($commentBuilder, $commentRepositoy);
        static::assertInstanceOf(AddCommentTypeHandler::class, $addCommentTypeHandler);
    }

    public function testHandle()
    {

    }
}