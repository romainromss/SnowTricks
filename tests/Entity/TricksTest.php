<?php

namespace Tests\Entity;


use App\Entity\Pictures;
use App\Entity\Tricks;
use App\Entity\Users;
use PHPUnit\Framework\TestCase;

class TricksTest extends TestCase
{
    private $trick;

    public function testTricksIsInstanceOf()
    {

        $pictures = $this->createMock(Pictures::class);
        $users = $this->createMock(Users::class);

        $trick = new Tricks(
            'un nom',
            'description',
            'group',
            $users,
            $pictures
        );

        $this->trick = $trick;

        static::assertInstanceOf(Tricks::class, $this->trick);
    }

    public function testGoodAttributes()
    {
        $pictures = $this->createMock(Pictures::class);
        $users = $this->createMock(Users::class);

            $trick = new Tricks(
                'un nom',
                'description',
                'group',
                $users,
                $pictures
            );
        $this->trick = $trick;

        static::assertObjectHasAttribute('id', $this->trick);
        static::assertObjectHasAttribute('name', $this->trick);
        static::assertObjectHasAttribute('description', $this->trick);
        static::assertObjectHasAttribute('group', $this->trick);
        static::assertObjectHasAttribute('createdAt', $this->trick);
        static::assertObjectHasAttribute('updatedAt', $this->trick);
        static::assertObjectHasAttribute('pictures', $this->trick);
        static::assertObjectHasAttribute('movies', $this->trick);
        static::assertObjectHasAttribute('user', $this->trick);
    }

    public function testGetters()
    {
        $user = $this->createMock(Users::class);
        $trick = new Tricks('name', 'description', 'group', $user);

        static::assertNotNull('test', $trick->getId());
        static::assertEquals('name', $trick->getName());
        static::assertEquals('description', $trick->getDescription());
        static::assertEquals('group', $trick->getGroup());
        static::assertNotSame(0, $trick->getCreatedAt());
        static::assertNotSame(0, $trick->getUpdatedAt());
        static::assertInstanceOf(Users::class, $trick->getUser());
        static::assertCount(0, $trick->getMovies());
        static::assertCount(0, $trick->getPictures());
        static::assertCount(0, $trick->getComments());
    }
}

