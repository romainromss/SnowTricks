<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\CommentsInterface;
use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

class Tricks implements TricksInterface
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
     * @return \ArrayAccess
     */
    public function getPictures(): \ArrayAccess
    {
        return $this->pictures;
    }

    /**
     * @return \ArrayAccess
     */
    public function getComments(): \ArrayAccess
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }


    /**
     * @return int|null
     */
    public function getUpdatedAt(): ? int
    {
        return $this->updatedAt;
    }


    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }


    /**
     * @return \ArrayAccess
     */
    public function getMovies(): \ArrayAccess
    {
        return $this->movies;
    }


    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }


    /**
     * @param PicturesInterface $pictures
     */
    public function addPictures(PicturesInterface $pictures): void
    {
        $this->pictures[] = $pictures;
    }


    /**
     * @param PicturesInterface $pictures
     */
    public function unsetPictures(PicturesInterface $pictures): void
    {
        unset($this->pictures[array_search($pictures, (array) $this->pictures, true)]);
    }


    /**
     * @param MoviesInterface $movies
     */
    public function addMovies(MoviesInterface $movies): void
    {
        $this->movies[] = $movies;
    }


    /**
     * @param MoviesInterface $movies
     */
    public function unsetMovies(MoviesInterface $movies): void
    {
        unset($this->movies[array_search($movies, (array) $this->movies, true)]);
    }


    /**
     * @param CommentsInterface $comment
     */
    public function addComments(CommentsInterface $comment): void
    {
        $this->comments[] = $comment;
    }


    /**
     * @param CommentsInterface $comment
     */
    public function unsetComment(CommentsInterface $comment): void
    {
        unset($this->comments[array_search($this->comments, (array) $this->comments, true)]);
    }
}