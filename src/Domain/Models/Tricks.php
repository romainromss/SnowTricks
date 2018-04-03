<?php

namespace App\Domain\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

class Tricks
{
    private $pictures;
    private $comments;
    private $movies;
    private $user;
    private $id;
    private $name;
    private $description;
    private $group;
    private $slug;
    private $updatedAt;
    private $createdAt;


    /**
     * Tricks constructor.
     *
     * @param string $name
     * @param string $description
     * @param string $group
     * @param string $slug
     * @param Users $user
     * @param Pictures|null $pictures
     * @param Movies|null $movies
     * @param Comments $comments
     */
    public function __construct(
        string $name,
        string $description,
        string $group,
        string $slug,
        Users $user,
        Pictures $pictures = null,
        Movies $movies = null,
        Comments $comments = null
    ) {
        $this->id = Uuid::uuid4();
        $this->createdAt = time();
        $this->name = $name;
        $this->description = $description;
        $this->group = $group;
        $this->slug = $slug;
        $this->user = $user;
        $this->pictures = new ArrayCollection();
        $this->movies = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param array $pictures
     *
     * @return array
     */
    public function addPictures(array $pictures)
    {
        return $this->pictures[] = $pictures;
    }

    /**
     * @param array $pictures
     */
    public function unsetPictures(array $pictures)
    {
        unset($pictures['pictures']);
    }
}

