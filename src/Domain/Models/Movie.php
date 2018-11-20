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

use App\Domain\Models\Interfaces\MovieInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Movie.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Movie implements MovieInterface
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
   * Movie constructor.
   *
   * @param string $embed
   * @param string $legend
   *
   * @throws \Exception
   */
    public function __construct(
        string $embed,
        string $legend
    ) {
        $this->id = Uuid::uuid4();
        $this->embed = $embed;
        $this->legend = $legend;
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
}
