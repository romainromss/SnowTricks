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


use App\Domain\Models\Pictures;
use App\Domain\Models\Tricks;
use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;

/**
 * Class PicturesTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PicturesTest extends TestCase
{
    /**
     * @var Users
     */
    private $users;
    /**
     * @var Tricks
     */
    private $tricks;

    /**
     * @var Pictures
     */
    private $pictures;

    protected function setUp()
    {
        $this->users = $this->createMock(Users::class);
        $this->tricks = $this->createMock(Tricks::class);

        $this->pictures = new Pictures(
            'name',
            'legend',
            true,
            'avatar',
            $this->tricks,
            $this->users
        );
    }

    public function testTricksIsInstanceOf()
    {
        static::assertInstanceOf(Pictures::class, $this->pictures);
    }

    public function testGoodAttributes()
    {
        static::assertObjectHasAttribute('id', $this->pictures);
        static::assertObjectHasAttribute('name', $this->pictures);
        static::assertObjectHasAttribute('legend', $this->pictures);
		static::assertTrue(true, $this->pictures);
        static::assertObjectHasAttribute('avatar', $this->pictures);
    }

    public function testReturnOfGetters()
    {
        static::assertNotNull($this->pictures->getId());
        static::assertEquals('name', $this->pictures->getName());
        static::assertEquals('legend', $this->pictures->getLegend());
		static::assertEquals(true, $this->pictures->isFirst());
        static::assertEquals('avatar', $this->pictures->getAvatar());
        static::assertInstanceOf(Users::class, $this->pictures->getUser());
        static::assertInstanceOf(Tricks::class, $this->pictures->getTrick());
    }
}
