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

namespace App\Tests\Domain\Builder;

use App\Domain\Builder\CommentBuilder;
use App\Domain\Models\Comments;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CommentBuilderTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentBuilderTest extends TestCase
{
    public function testInstanceOf()
    {
        $commentBuilder = new CommentBuilder();
        static::assertInstanceOf(CommentBuilder::class, $commentBuilder);
    }

    public function testcreate()
    {
        $tricks = $this->createMock(TricksInterface::class);
        $content = 'content';
        $users = $this->createMock(UsersInterface::class);

        $comment = new CommentBuilder();
        $comment->create($content, $tricks, $users);

        static::assertInstanceOf(Comments::class, $comment->getComment());
    }
}