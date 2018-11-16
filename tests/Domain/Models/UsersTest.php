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

namespace App\Tests\Domain\Models;

use App\Domain\Models\Comment;
use App\Domain\Models\Picture;
use App\Domain\Models\Trick;
use App\Domain\Models\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UsersTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UsersTest extends TestCase
{
    /**
     * @var Picture
     */
    private $pictures;
    /**
     * @var Trick
     */
    private $tricks;
    /**
     * @var Comment
     */
    private $comments;
    /**
     * @var User
     */
    private $users;

    protected function setUp()
    {
        $this->pictures = $this->createMock(Picture::class);
        $this->tricks = $this->createMock(Trick::class);
        $this->comments = $this->createMock(Comment::class);

        $this->users = new User(
            'username',
            'email',
            'name',
            'lastname',
            'ads#p23*',
            'user',
            $this->pictures,
			['tricks'],
			['comments']
        );
    }

    public function testUsersIsInstanceOf()
    {
        static::assertInstanceOf(User::class, $this->users);
    }

    public function testGoodAttributes()
    {
        static::assertObjectHasAttribute('id', $this->users);
        static::assertObjectHasAttribute('username', $this->users);
        static::assertObjectHasAttribute('email', $this->users);
        static::assertObjectHasAttribute('name', $this->users);
        static::assertObjectHasAttribute('lastname', $this->users);
        static::assertObjectHasAttribute('password', $this->users);
        static::assertObjectHasAttribute('role', $this->users);
        static::assertObjectHasAttribute('pictures', $this->users);
        static::assertObjectHasAttribute('tricks', $this->users);
        static::assertObjectHasAttribute('comments', $this->users);
    }


    public function testReturnOfGetters()
    {
        static::assertNotNull($this->users->getId());
        static::assertEquals('username', $this->users->getUsername());
        static::assertEquals('email', $this->users->getEmail());
        static::assertSame('name', $this->users->getName());
        static::assertSame('lastname', $this->users->getLastname());
        static::assertSame('ads#p23*', $this->users->getPassword());
        static::assertEquals('user', $this->users->getRole());
        static::assertNotNull(new \DateTime('now'), $this->users->getCreatedAt());
        static::assertInstanceOf(Picture::class, $this->users->getPictures());
        static::assertCount(1, $this->users->getTricks());
        static::assertCount(1, $this->users->getComments());
    }
}
