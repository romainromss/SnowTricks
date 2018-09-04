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

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Tricks;

/**
 * Interface MoviesInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface MoviesInterface
{
    public function __construct(
        string $embed,
        string $legend
    );

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getEmbed();

    /**
     * @return mixed
     */
    public function getLegend();
}
