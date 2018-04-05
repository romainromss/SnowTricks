<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\PicturesInterface;
use Ramsey\Uuid\Uuid;

class Pictures implements PicturesInterface
{
    private $trick;
    private $user;
    private $id;
    private $name;
    private $legend;
    private $avatar;

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
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->legend = $legend;
        $this->avatar = $avatar;
        $this->trick = $tricks;
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getTrick()
    {
        return $this->trick;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
