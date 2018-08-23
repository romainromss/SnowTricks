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
    private $category;

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
	 * @var \ArrayAccess
	 */
	private $pictures;

	/**
	 * @var \ArrayAccess
	 */
	private $comments;

	/**
	 * @var \ArrayAccess
	 */
	private $movies;

	/**
	 * @var UsersInterface
	 */
	private $users;



    public function __construct(
        string $name,
        string $description,
        string $category,
        UsersInterface $users,
        array $pictures = null,
        array $movies = null,
        array $comments = null
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->slug = strtr($name, [' ' => '-']);
        $this->createdAt = time();
        $this->users = $users;
        $this->pictures = new ArrayCollection($pictures ?? []);
        $this->movies = new ArrayCollection($movies ?? []);
		$this->comments = new ArrayCollection($comments ?? []);
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
        return $this->category;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): ? string
    {
        return $this->updatedAt;
    }

	/**
	 * @return \DateTime
	 */
    public function getCreatedAt(): \DateTime
    {
        return \DateTime::createFromFormat('U', (string) $this->createdAt);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

	/**
	 * @return UsersInterface | string
	 */
	public function getUsers()
	{
		return $this->users;
	}

	/**
	 * @return \ArrayAccess
	 */
	public function getMovies()
	{
		return $this->movies;
	}

	/**
	 * @return \ArrayAccess
	 */
	public function getPictures()
	{
		return $this->pictures;
	}

	/**
	 * @return \ArrayAccess
	 */
	public function getComments()
	{
		return $this->comments;
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
