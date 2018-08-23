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


use App\Domain\Models\Movies;
use App\Domain\Models\Tricks;
use PHPUnit\Framework\TestCase;

/**
 * Class MoviesTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MoviesTest extends TestCase
{
    /**
     * @var Tricks
     */
    private $trick;
    /**
     * @var Movies
     */
    private $movies;

    protected function setUp()
    {
        $this->trick = $this->createMock(Tricks::class);

        $this->movies = new Movies(
            'embed',
            'legend',
            $this->trick
        );
    }

    public function testTricksIsInstanceOf()
    {
        static::assertInstanceOf(Movies::class, $this->movies);
    }

    public function testGoodAttributes()
    {
        static::assertObjectHasAttribute('id', $this->movies);
        static::assertObjectHasAttribute('embed', $this->movies);
        static::assertObjectHasAttribute('legend', $this->movies);
        static::assertObjectHasAttribute('trick', $this->movies);

    }

    public function testReturnOfGetters()
    {
        static::assertNotNull($this->movies->getId());
        static::assertEquals('embed', $this->movies->getEmbed());
        static::assertEquals('legend', $this->movies->getLegend());
        static::assertInstanceOf(Tricks::class, $this->movies->getTricks());
    }
}
