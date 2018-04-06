<?php
declare(strict_types=1);
/**
 * Created by romss.
 * Date: 05/04/2018
 * Time: 09:25
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Tricks;
use App\Domain\Models\Users;

/**
 * Interface PicturesInterface
 *
 * @package App\Domain\Models\Interfaces
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface PicturesInterface
{
    /**
     * Pictures constructor.
     *
     * @param string $name
     * @param string $legend
     * @param string $avatar
     * @param Tricks|null $tricks
     * @param Users|null $user
     */
    public function __construct(
        string $name,
        string $legend,
        string $avatar = null,
        Tricks $tricks = null,
        Users $user = null
    );

    /**
     * @return mixed
     */
    public function getTrick();

    /**
     * @return mixed
     */
    public function getUser();

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getLegend();

    /**
     * @return mixed
     */
    public function getAvatar();
}
