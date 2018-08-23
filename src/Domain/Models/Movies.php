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

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Movies.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Movies implements MoviesInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $embed;

    /**
     * @var string
     */
    private $legend;

    /**
     * @var TricksInterface
     */
    private $trick;

    /**
     * Movies constructor.
     *
     * @param string       $embed
     * @param string       $legend
     * @param Tricks|null  $tricks
     */
    public function __construct(
        string $embed,
        string $legend,
        Tricks $tricks = null
    ) {
        $this->id = Uuid::uuid4();
        $this->embed = $embed;
        $this->legend = $legend;
        $this->trick = $tricks;
    }

    /**
     * @return UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @return TricksInterface
     */
    public function getTricks()
    {
        return $this->trick;
    }
}
