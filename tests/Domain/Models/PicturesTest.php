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


use App\Domain\Models\Pictures;
use App\Domain\Models\Tricks;
use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;

/**
 * Class PicturesTest
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PicturesTest extends TestCase
{
    /**
     *@test
     */
    public function testTricksIsInstanceOf()
    {
        $users = $this->createMock(Users::class);
        $tricks = $this->createMock(Tricks::class);

        $pictures = new Pictures(
            'name',
            'legend',
            'pictures',
            true,
            'avatar',
            $tricks,
            $users
        );

        static::assertInstanceOf(Pictures::class, $pictures);
    }

    /**
     *@test
     */
    public function testGoodAttributes()
    {
        $pictures = new Pictures(
            'name',
            'legend',
            'pictures',
            true,
            'avatar'
        );

        static::assertObjectHasAttribute('id', $pictures);
        static::assertObjectHasAttribute('name', $pictures);
        static::assertObjectHasAttribute('legend', $pictures);
        static::assertObjectHasAttribute('pictures', $pictures);
        static::assertTrue(true, $pictures);
        static::assertObjectHasAttribute('avatar', $pictures);
    }

    /**
     *@test
     */
    public function testReturnOfGetters()
    {
        $users = $this->createMock(Users::class);
        $tricks = $this->createMock(Tricks::class);

        $pictures = new Pictures(
            'name',
            'legend',
            'pictures',
            true,
            'avatar',
            $tricks,
            $users
        );

        static::assertNotNull($pictures->getId());
        static::assertEquals('name', $pictures->getName());
        static::assertEquals('legend', $pictures->getLegend());
        static::assertEquals('pictures', $pictures->getPictures());
        static::assertEquals(true, $pictures->isFirst());
        static::assertEquals('avatar', $pictures->getAvatar());
        static::assertInstanceOf(Users::class, $pictures->getUser());
        static::assertInstanceOf(Tricks::class, $pictures->getTrick());
    }
}