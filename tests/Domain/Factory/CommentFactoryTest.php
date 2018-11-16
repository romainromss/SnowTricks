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

use App\Domain\Factory\CommentFactory;
use App\Domain\Models\Comment;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UserInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CommentBuilderTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentFactoryTest extends TestCase
{
    /**
     * @var TrickInterface
     */
    private $tricks;
    /**
     * @var string
     */
    private $content;
    /**
     * @var UserInterface
     */
    private $users;

    protected function setUp()
    {
        $this->tricks = $this->createMock(TrickInterface::class);
        $this->content = 'content';
        $this->users = $this->createMock(UserInterface::class);
    }
    public function testInstanceOf()
    {
        $commentBuilder = new CommentFactory();
        static::assertInstanceOf(CommentFactory::class, $commentBuilder);
    }

    public function testcreate()
    {
        $comment = new CommentFactory();
        $comment->create(
          $this->content,
          $this->tricks,
          $this->users
        );

        static::assertInstanceOf(CommentFactory::class, $comment);
    }
}
