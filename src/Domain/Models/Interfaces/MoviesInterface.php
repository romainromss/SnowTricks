<?php
/**
 * Created by PhpStorm.
 * Users: romss
 * Date: 05/04/2018
 * Time: 09:24
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Tricks;

interface MoviesInterface
{
    public function __construct(
        string $embed,
        string $legend,
        Tricks $tricks = null
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

    /**
     * @return mixed
     */
    public function getTricks();
}