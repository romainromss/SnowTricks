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


use App\Domain\Models\Picture;
use App\Domain\Models\Trick;
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
     * @var Trick
     */
    private $tricks;

    /**
     * @var Picture
     */
    private $pictures;

    protected function setUp()
    {
        $this->pictures = new Picture(
            'name',
            'legend',
            true
        );
    }

    public function testTricksIsInstanceOf()
    {
        static::assertInstanceOf(Picture::class, $this->pictures);
    }

    public function testGoodAttributes()
    {
        static::assertObjectHasAttribute('id', $this->pictures);
        static::assertObjectHasAttribute('name', $this->pictures);
        static::assertObjectHasAttribute('legend', $this->pictures);
		static::assertTrue(true, $this->pictures);
		static::assertFalse(false, $this->pictures);
    }

    public function testReturnOfGetters()
    {
        static::assertNotNull($this->pictures->getId());
        static::assertEquals('name', $this->pictures->getName());
        static::assertEquals('legend', $this->pictures->getLegend());
		static::assertEquals(true, $this->pictures->isFirst());
		static::assertEquals(false, $this->pictures->addFirst(false));
    }
}
