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


use App\Domain\Models\Movies;
use App\Domain\Models\Tricks;
use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;

class MoviesTest extends TestCase
{

    /**
     *@test
     */
    public function testTricksIsInstanceOf()
    {
        $trick = $this->createMock(Tricks::class);

        $movies = new Movies(
            'embed',
            'legend',
            $trick
        );

        static::assertInstanceOf(Movies::class, $movies);
    }

    /**
     *@test
     */
    public function testGoodAttributes()
    {
        $trick = $this->createMock(Tricks::class);

        $movies = new Movies(
            'embed',
            'legend',
            $trick
        );

        static::assertObjectHasAttribute('id', $movies);
        static::assertObjectHasAttribute('embed', $movies);
        static::assertObjectHasAttribute('legend', $movies);
        static::assertObjectHasAttribute('trick', $movies);

    }


    /**
     *@test
     */
    public function testReturnOfGetters()
    {
        $trick = $this->createMock(Tricks::class);

        $movies = new Movies(
            'embed',
            'legend',
            $trick
        );

        static::assertNotNull($movies->getId());
        static::assertEquals('embed', $movies->getEmbed());
        static::assertEquals('legend', $movies->getLegend());
        static::assertInstanceOf(Tricks::class, $movies->getTricks());
    }
}