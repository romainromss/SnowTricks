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

use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Pictures.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Pictures implements PicturesInterface
{
    /**
     * @var TricksInterface|null
     */
    private $trick;
    /**
     * @var UsersInterface|null
     */
    private $users;
    /**
     * @var UuidInterface
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $legend;
    /**
     * @var null|string
     */
    private $pictures;
    /**
     * @var bool
     */
    private $first;
    /**
     * @var null|string
     */
    private $avatar;


    /**
     * Pictures constructor.
     *
     * @param string                $name
     * @param string                $legend
     * @param string|null           $pictures
     * @param bool                  $first
     * @param string|null           $avatar
     * @param TricksInterface|null  $tricks
     * @param UsersInterface|null   $user
     */
    public function __construct(
        string $name,
        string $legend,
        string $pictures = null,
        bool $first,
        string $avatar = null,
        TricksInterface $tricks = null,
        UsersInterface $user = null
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->legend = $legend;
        $this->pictures = $pictures;
        $this->first = $first;
        $this->avatar = $avatar;
        $this->trick = $tricks;
        $this->users = $user;
    }

    /**
     * @return TricksInterface
     */
    public function getTrick()
    {
        return $this->trick;
    }


    /**
     * @return UsersInterface
     */
    public function getUser()
    {
        return $this->users;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @return bool
     */
    public function isFirst(): bool
    {
        return $this->first;
    }

    /**
     * @return null|string
     */
    public function getPictures(): ? string
    {
        return $this->pictures;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
