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
use App\Domain\Models\Users;
use Ramsey\Uuid\UuidInterface;

/**
 * Interface PicturesInterface.
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
     * @param string|null $pictures
     * @param bool $first
     * @param string|null $avatar
     * @param TricksInterface|null $tricks
     * @param UsersInterface|null $user
     */
    public function __construct(
        string $name,
        string $legend,
        string $pictures = null,
        bool $first,
        string $avatar = null,
        TricksInterface $tricks = null,
        UsersInterface $user = null
    );

    /**
     * @return TricksInterface
     */
    public function getTrick();

    /**
     * @return UsersInterface
     */
    public function getUser();

    /**
     * @return UuidInterface
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getLegend();

    /**
     * @return string
     */
    public function getAvatar();

    /**
     * @return string
     */
    public function getPictures();

    /**
     * @return bool
     */
    public function isFirst();
}
