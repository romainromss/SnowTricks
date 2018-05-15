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
use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Users.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Users implements UsersInterface
{

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $role;

    /**
     * @var string
     */
    private $createdAt;

	/**
	 * @var PicturesInterface
	 */
	private $pictures;

	/**
	 * @var \ArrayAccess
	 *
	 */
	private $tricks;

	/**
	 * @var \ArrayAccess
	 */
	private $comments;


	/**
	 * Users constructor.
	 *
	 * @param string             $username
	 * @param string             $email
	 * @param string             $name
	 * @param string             $lastname
	 * @param string             $password
	 * @param string             $role
	 * @param PicturesInterface  $pictures
	 * @param array       $tricks
	 * @param array       $comments
	 */
    public function __construct(
        string $username,
        string $email,
        string $name,
        string $lastname,
        string $password,
        string $role,
        PicturesInterface $pictures,
        array $tricks = null,
        array $comments = null
    ) {
        $this->id = Uuid::uuid4();
        $this->username = $username;
        $this->email = $email;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->role = $role;
        $this->createdAt = time();
        $this->pictures = $pictures;
        $this->tricks = new ArrayCollection($tricks);
        $this->comments = new ArrayCollection($comments);
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
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
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

	/**
	 * @return bool|\DateTime
	 */
    public function getCreatedAt(): \DateTime
    {
        return \DateTime::createFromFormat('U', (string) $this->createdAt);
    }

	/**
	 * @return PicturesInterface
	 */
    public function getPictures(): PicturesInterface
    {
        return $this->pictures;
    }

	/**
	 * @return \ArrayAccess
	 */
	public function getTricks(): \ArrayAccess
	{
		return $this->tricks;
	}

	/**
	 * @return \ArrayAccess
	 */
	public function getComments(): \ArrayAccess
	{
		return $this->comments;
	}
}
