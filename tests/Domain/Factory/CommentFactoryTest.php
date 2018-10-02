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

namespace App\Tests\Domain\Factory;

use App\Domain\Factory\CommentsFactory;
use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CommentBuilderTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentFactoryTest extends TestCase
{
    /**
     * @var TricksInterface
     */
    private $tricks;
    /**
     * @var string
     */
    private $content;
    /**
     * @var UsersInterface
     */
    private $users;

    protected function setUp()
    {
        $this->tricks = $this->createMock(TricksInterface::class);
        $this->content = 'content';
        $this->users = $this->createMock(UsersInterface::class);
    }
    public function testInstanceOf()
    {
        $commentBuilder = new CommentsFactory();
        static::assertInstanceOf(CommentsFactory::class, $commentBuilder);
    }

    public function testcreate()
    {
        $comment = new CommentsFactory();
        $comment->create(
          $this->content,
          $this->tricks,
          $this->users
        );

        static::assertInstanceOf(CommentsFactory::class, $comment);
    }
}
