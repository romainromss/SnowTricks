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

class UsersTest extends TestCase
{
    /**
     *@test
     */
    public function testUsersIsInstanceOf()
    {
        $pictures = $this->createMock(Pictures::class);
        $tricks = $this->createMock(Tricks::class);
        $comments = $this->createMock(Comments::class);

        $users = new Users(
            'username',
            'email@gmail.com',
            'name',
            'lastname',
            'ads#p23*',
            'user',
            '2344023',
            $pictures,
            $tricks,
            $comments
        );

        static::assertInstanceOf(Users::class, $users);
    }

    /**
     *@test
     */
    public function testGoodAttributes()
    {
        $pictures = $this->createMock(Pictures::class);
        $tricks = $this->createMock(Tricks::class);
        $comments = $this->createMock(Comments::class);

        $users = new Users(
            'username',
            'email',
            'name',
            'lastname',
            'ads#p23*',
            'user',
            '2344023',
            $pictures,
            $tricks,
            $comments
        );

        static::assertObjectHasAttribute('id', $users);
        static::assertObjectHasAttribute('username', $users);
        static::assertObjectHasAttribute('email', $users);
        static::assertObjectHasAttribute('name', $users);
        static::assertObjectHasAttribute('lastname', $users);
        static::assertObjectHasAttribute('password', $users);
        static::assertObjectHasAttribute('role', $users);
        static::assertObjectHasAttribute('createdAt', $users);
        static::assertObjectHasAttribute('pictures', $users);
        static::assertObjectHasAttribute('tricks', $users);
        static::assertObjectHasAttribute('comments', $users);
    }


    /**
     *@test
     */
    public function testReturnOfGetters()
    {
        $pictures = $this->createMock(Pictures::class);
        $tricks = $this->createMock(Tricks::class);
        $comments = $this->createMock(Comments::class);

        $users = new Users(
            'username',
            'email',
            'name',
            'lastname',
            'ads#p23*',
            'user',
            '2344023',
            $pictures,
            $tricks,
            $comments
        );

        static::assertNotNull($users->getId());
        static::assertEquals('username', $users->getUsername());
        static::assertEquals('email', $users->getEmail());
        static::assertSame('name', $users->getName());
        static::assertSame('lastname', $users->getLastname());
        static::assertSame('ads#p23*', $users->getPassword());
        static::assertEquals('user', $users->getRole());
        static::assertEquals('2344023', $users->getCreatedAt());
        static::assertInstanceOf(Pictures::class, $users->getPictures());
        static::assertInstanceOf(Tricks::class, $users->getTricks());
        static::assertInstanceOf(Comments::class, $users->getComments());
    }
}