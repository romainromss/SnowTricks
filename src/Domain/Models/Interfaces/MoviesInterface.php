<?php
declare(strict_types=1);
/**
 * Created by romss.
 * Date: 05/04/2018
 * Time: 09:24
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Tricks;

/**
 * Interface MoviesInterface
 *
 * @package App\Domain\Models\Interfaces
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
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
