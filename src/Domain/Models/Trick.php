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

use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\CommentInterface;
use App\Domain\Models\Interfaces\MovieInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Trick.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Trick implements TrickInterface
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
	private $picture;

	/**
	 * @var \ArrayAccess
	 */
	private $comment;

	/**
	 * @var \ArrayAccess
	 */
	private $movie;

	/**
	 * @var UsersInterface
	 */
	private $user;



    public function __construct(
      string $name,
      string $description,
      string $category,
      UsersInterface $user,
      array $picture = null,
      array $movie = null
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->slug = strtr($name, [' ' => '-']);
        $this->createdAt = time();
        $this->user = $user;
        $this->picture = new ArrayCollection($picture ?? []);
        $this->movie = new ArrayCollection($movie ?? []);
		$this->comment = new ArrayCollection();
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
		return $this->user;
	}

	/**
	 * @return \ArrayAccess
	 */
	public function getMovies()
	{
		return $this->movie;
	}

	/**
	 * @return \ArrayAccess
	 */
	public function getPictures()
	{
		return $this->picture;
	}

	/**
	 * @return \ArrayAccess
	 */
	public function getComments()
	{
		return $this->comment;
	}
  
  /**
   * @param PictureInterface $pictures
   */
    public function addPictures(PictureInterface $pictures): void
    {
        $this->picture[] = $pictures;
    }

    
    public function removePicture(Picture $picture)
    {
      $this->picture->removeElement($picture);
    }
  
  /**
   * @param MovieInterface $movies
   */
    public function addMovies(MovieInterface $movies): void
    {
        $this->movie[] = $movies;
    }
  
  public function removeMovie(Movie $movie)
  {
    $this->movie->removeElement($movie);
  }
  

    /**
     * @param CommentInterface $comment
     */
    public function addComments(CommentInterface $comment): void
    {
        $this->comment[] = $comment;
    }
    
    
    public function updateTrick(UpdateTrickDTO $updateTrickDTO)
    {
      $this->name = $updateTrickDTO->name;
      $this->description = $updateTrickDTO->description;
      $this->category = $updateTrickDTO->category;
    }
}
