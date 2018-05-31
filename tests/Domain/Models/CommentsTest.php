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
 * Class TricksTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentsTest extends TestCase
{
    /**
     * @var Users
     */
    private $user;
    /**
     * @var Tricks
     */
    private $trick;
    /**
     * @var Comments
     */
    private $comments;

    protected function setUp()
    {
        $this->user = $this->createMock(Users::class);
        $this->trick = $this->createMock(Tricks::class);

        $this->comments = new Comments(
            'content',
            $this->trick,
            $this->user
        );

    }

    public function testTricksIsInstanceOf()
    {
        static::assertInstanceOf(Comments::class, $this->comments);
    }

    public function testGoodAttributes()
    {
        static::assertObjectHasAttribute('id', $this->comments);
        static::assertObjectHasAttribute('content', $this->comments);
        static::assertObjectHasAttribute('createdAt', $this->comments);
        static::assertObjectHasAttribute('trick', $this->comments);
        static::assertObjectHasAttribute('users', $this->comments);
    }

    public function testReturnOfGetters()
    {
        static::assertNotNull($this->comments->getId());
        static::assertEquals('content', $this->comments->getContent());
        static::assertNotNull(0, $this->comments->getCreatedAt());
        static::assertInstanceOf(Users::class, $this->comments->getUsers());
        static::assertInstanceOf(Tricks::class, $this->comments->getTrick());
    }
}
