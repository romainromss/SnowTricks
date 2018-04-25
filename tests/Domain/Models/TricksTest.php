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

namespace Tests\Entity;

use App\Domain\Models\Comments;
use App\Domain\Models\Movies;
use App\Domain\Models\Pictures;
use App\Domain\Models\Tricks;
use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;

/**
 * Class TricksTest
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TricksTest extends TestCase
{

    /**
     *@test
     */
    public function testTricksIsInstanceOf()
    {
        $user = $this->createMock(Users::class);

        $trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $user
        );

        static::assertInstanceOf(Tricks::class, $trick);
    }

    /**
     *@test
     */
    public function testGoodAttributes()
    {
        $user = $this->createMock(Users::class);

        $trick = new Tricks(
                'un nom',
                'description',
                'group',
                'slug',
                $user
            );

        static::assertObjectHasAttribute('id', $trick);
        static::assertObjectHasAttribute('name', $trick);
        static::assertObjectHasAttribute('description', $trick);
        static::assertObjectHasAttribute('group', $trick);
        static::assertObjectHasAttribute('slug', $trick);
        static::assertObjectHasAttribute('createdAt', $trick);
        static::assertObjectHasAttribute('updatedAt', $trick);
        static::assertObjectHasAttribute('pictures', $trick);
        static::assertObjectHasAttribute('movies', $trick);
        static::assertObjectHasAttribute('users', $trick);
    }


    /**
     *@test
     */
    public function testReturnOfGetters()
    {
        $user = $this->createMock(Users::class);
        $trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $user
        );

        static::assertNotNull($trick->getId());
        static::assertEquals('name', $trick->getName());
        static::assertEquals('description', $trick->getDescription());
        static::assertEquals('group', $trick->getGroup());
        static::assertEquals('slug', $trick->getSlug());
        static::assertNotNull(0, $trick->getCreatedAt());
        static::assertNotNull(0, $trick->getUpdatedAt());
        static::assertInstanceOf(Users::class, $trick->getUsers());
        static::assertCount(0, $trick->getMovies());
        static::assertCount(0, $trick->getPictures());
        static::assertCount(0, $trick->getComments());
    }

    public function testAddPictures()
    {
        $user = $this->createMock(Users::class);
        $trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $user
        );

        static::assertCount(0, $trick->getPictures());

        $trick->addPictures(new Pictures('pictures', 'pictures', '', false));
        static::assertCount(1, $trick->getPictures());
    }

    public function testUnsetPictures()
    {
        $pictures = new Pictures('pictures', 'pictures', '', false);
        $user = $this->createMock(Users::class);
        $trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $user
        );

        static::assertCount(0, $trick->getPictures());

        $trick->addPictures($pictures);
        static::assertCount(1, $trick->getPictures());

        $trick->unsetPictures($pictures);
        static::assertCount(0, $trick->getPictures());
    }

    public function testAddMovies()
    {
        $movies = new Movies('movies', 'movies');
        $user = $this->createMock(Users::class);
        $trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $user
        );

        static::assertCount(0, $trick->getMovies());

        $trick->addMovies($movies);
        static::assertCount(1, $trick->getMovies());
    }

    public function testUnsetMovies()
    {
        $movies = new Movies('movies', 'movies');
        $user = $this->createMock(Users::class);
        $trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $user
        );

        static::assertCount(0, $trick->getMovies());

        $trick->addMovies($movies);
        static::assertCount(1, $trick->getMovies());

        $trick->unsetMovies($movies);
        static::assertCount(0, $trick->getPictures());
    }

    public function testAddComments()
    {
        $user = $this->createMock(Users::class);
        $trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $user
        );
        $comment = new Comments('comment',  $trick, $user);

        static::assertCount(0, $trick->getComments());

        $trick->addComments($comment);
        static::assertCount(1, $trick->getComments());
    }

    public function testUnsetComment()
    {
        $user = $this->createMock(Users::class);
        $trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $user
        );
        $comment = new Comments('comment',  $trick, $user);

        static::assertCount(0, $trick->getComments());

        $trick->addComments($comment);
        static::assertCount(1, $trick->getComments());

        $trick->unsetComment($comment);
        static::assertCount(0, $trick->getComments());
    }
}
