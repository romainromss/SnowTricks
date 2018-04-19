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

namespace App\Tests\Domain\Models;

use App\Domain\Models\Comments;
use App\Domain\Models\Tricks;
use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;

/**
 * Class TricksTest
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentsTest extends TestCase
{

    /**
     *@test
     */
    public function testTricksIsInstanceOf()
    {
        $user = $this->createMock(Users::class);
        $trick = $this->createMock(Tricks::class);

        $comments = new Comments(
            'content',
            $trick,
            $user
        );

        static::assertInstanceOf(Comments::class, $comments);
    }

    /**
     *@test
     */
    public function testGoodAttributes()
    {
        $user = $this->createMock(Users::class);
        $trick = $this->createMock(Tricks::class);

        $comments = new Comments(
            'content',
            $trick,
            $user
        );

        static::assertObjectHasAttribute('id', $comments);
        static::assertObjectHasAttribute('content', $comments);
        static::assertObjectHasAttribute('createdAt', $comments);
        static::assertObjectHasAttribute('trick', $comments);
        static::assertObjectHasAttribute('users', $comments);
    }


    /**
     *@test
     */
    public function testReturnOfGetters()
    {
        $user = $this->createMock(Users::class);
        $trick = $this->createMock(Tricks::class);

        $comments = new Comments(
            'content',
            $trick,
            $user
        );

        static::assertNotNull($comments->getId());
        static::assertEquals('content', $comments->getContent());
        static::assertNotNull(0, $comments->getCreatedAt());
        static::assertInstanceOf(Users::class, $comments->getUsers());
        static::assertInstanceOf(Tricks::class, $comments->getTrick());
    }
}
