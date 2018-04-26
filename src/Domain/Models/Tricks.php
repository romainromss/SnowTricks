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

use App\Domain\Models\Interfaces\CommentsInterface;
use App\Domain\Models\Interfaces\MoviesInterface;
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Tricks.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Tricks implements TricksInterface
{
    /**
     * @var ArrayCollection
     */
    private $pictures;
    /**
     * @var ArrayCollection
     */
    private $comments;
    /**
     * @var ArrayCollection
     */
    private $movies;
    /**
     * @var UsersInterface
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
    private $description;
    /**
     * @var string
     */
    private $group;
    /**
     * @var string
     */
    private $slug;
    /**
     * @var string
     */
    private $updatedAt;
    /**
     * @var int
     */
    private $createdAt;


    /**
     * Tricks constructor.
     *
     * @param string                   $name
     * @param string                   $description
     * @param string                   $group
     * @param string                   $slug
     * @param UsersInterface           $users
     * @param PicturesInterface|null   $pictures
     * @param MoviesInterface|null     $movies
     * @param CommentsInterface        $comments
     */
    public function __construct(
        string $name,
        string $description,
        string $group,
        string $slug,
        UsersInterface $users,
        PicturesInterface $pictures = null,
        MoviesInterface $movies = null,
        CommentsInterface $comments = null
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->description = $description;
        $this->group = $group;
        $this->slug = $slug;
        $this->createdAt = time();
        $this->users = $users;
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
     * @return UsersInterface
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
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
     * @return string
     */
    public function getUpdatedAt(): ? string
    {
        return $this->updatedAt;
    }


    /**
     * @return int|mixed
     */
    public function getCreatedAt()
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
