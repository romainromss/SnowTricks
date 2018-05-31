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
use App\Domain\Models\Movies;
use App\Domain\Models\Pictures;
use App\Domain\Models\Tricks;
use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;

/**
 * Class TricksTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TricksTest extends TestCase
{
    /**
     * @var Tricks
     */
    private $trick;
    /**
     * @var Users
     */
    private $user;
    /**
     * @var Comments
     */
    private $comment;
    /**
     * @var Movies
     */
    private $movies;
    /**
     * @var Pictures
     */
    private $pictures;

    protected function setUp()
    {
        $this->user = $this->createMock(Users::class);

        $this->trick = new Tricks(
            'name',
            'description',
            'group',
            'slug',
            $this->user
        );

        $this->comment = new Comments('comment',  $this->trick, $this->user);
        $this->pictures = $this->createMock(Pictures::class);
        $this->movies = $this->createMock(Movies::class);

    }

    public function testTricksIsInstanceOf()
    {
        static::assertInstanceOf(Tricks::class, $this->trick);
    }

    /**
     *@test
     */
    public function testGoodAttributes()
    {
        static::assertObjectHasAttribute('id', $this->trick);
        static::assertObjectHasAttribute('name', $this->trick);
        static::assertObjectHasAttribute('description', $this->trick);
        static::assertObjectHasAttribute('group', $this->trick);
        static::assertObjectHasAttribute('slug', $this->trick);
        static::assertObjectHasAttribute('createdAt', $this->trick);
        static::assertObjectHasAttribute('updatedAt', $this->trick);
        static::assertObjectHasAttribute('pictures', $this->trick);
        static::assertObjectHasAttribute('movies', $this->trick);
        static::assertObjectHasAttribute('users', $this->trick);
    }


    /**
     *@test
     */
    public function testReturnOfGetters()
    {
        static::assertNotNull($this->trick->getId());
        static::assertEquals('name', $this->trick->getName());
        static::assertEquals('description', $this->trick->getDescription());
        static::assertEquals('group', $this->trick->getGroup());
        static::assertEquals('slug', $this->trick->getSlug());
        static::assertNotNull(new \DateTime('now'), $this->trick->getCreatedAt());
        static::assertNotNull(0, $this->trick->getUpdatedAt());
        static::assertInstanceOf(Users::class, $this->trick->getUsers());
        static::assertCount(0, $this->trick->getMovies());
        static::assertCount(0, $this->trick->getPictures());
        static::assertCount(0, $this->trick->getComments());
    }

    public function testAddPictures()
    {
        static::assertCount(0, $this->trick->getPictures());

        $this->trick->addPictures(new Pictures('pictures', 'pictures', true));
        static::assertCount(1, $this->trick->getPictures());
    }

    public function testUnsetPictures()
    {
        static::assertCount(0, $this->trick->getPictures());

        $this->trick->addPictures($this->pictures);
        static::assertCount(1, $this->trick->getPictures());

        $this->trick->unsetPictures($this->pictures);
        static::assertCount(0, $this->trick->getPictures());
    }

    public function testAddMovies()
    {
        static::assertCount(0, $this->trick->getMovies());

        $this->trick->addMovies($this->movies);
        static::assertCount(1, $this->trick->getMovies());
    }

    public function testUnsetMovies()
    {
        static::assertCount(0, $this->trick->getMovies());

        $this->trick->addMovies($this->movies);
        static::assertCount(1, $this->trick->getMovies());

        $this->trick->unsetMovies($this->movies);
        static::assertCount(0, $this->trick->getPictures());
    }

    public function testAddComments()
    {
        static::assertCount(0, $this->trick->getComments());

        $this->trick->addComments($this->comment);
        static::assertCount(1, $this->trick->getComments());
    }

    public function testUnsetComment()
    {
        static::assertCount(0, $this->trick->getComments());

        $this->trick->addComments($this->comment);
        static::assertCount(1, $this->trick->getComments());

        $this->trick->unsetComment($this->comment);
        static::assertCount(0, $this->trick->getComments());
    }
}
