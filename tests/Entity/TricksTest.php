<?php

namespace Tests\Entity;


use App\Domain\Tricks;
use App\Domain\Users;
use PHPUnit\Framework\TestCase;

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
        static::assertObjectHasAttribute('user', $trick);
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
        static::assertNotSame(0, $trick->getCreatedAt());
        static::assertNotSame(0, $trick->getUpdatedAt());
        static::assertInstanceOf(Users::class, $trick->getUser());
        static::assertCount(0, $trick->getMovies());
        static::assertCount(0, $trick->getPictures());
        static::assertCount(0, $trick->getComments());
    }

    public function testaddPictures()
    {

    }
}

