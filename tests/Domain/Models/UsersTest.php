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

namespace App\Tests\Entity;

use App\Domain\Models\Comments;
use App\Domain\Models\Pictures;
use App\Domain\Models\Tricks;
use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;

/**
 * Class UsersTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UsersTest extends TestCase
{
    /**
     * @var Pictures
     */
    private $pictures;
    /**
     * @var Tricks
     */
    private $tricks;
    /**
     * @var Comments
     */
    private $comments;
    /**
     * @var Users
     */
    private $users;

    public function setUp()
    {
        $this->pictures = $this->createMock(Pictures::class);
        $this->tricks = $this->createMock(Tricks::class);
        $this->comments = $this->createMock(Comments::class);

        $this->users = new Users(
            'username',
            'email',
            'name',
            'lastname',
            'ads#p23*',
            'user',
            $this->pictures,
            $this->tricks,
            $this->comments
        );
    }

    public function testUsersIsInstanceOf()
    {
        static::assertInstanceOf(Users::class, $this->users);
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
        static::assertNotNull(0, $this->users->getCreatedAt());
        static::assertInstanceOf(Pictures::class, $this->users->getPictures());
        static::assertInstanceOf(Tricks::class, $this->users->getTricks());
        static::assertInstanceOf(Comments::class, $this->users->getComments());
    }
}
