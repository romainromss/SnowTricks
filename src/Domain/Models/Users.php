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
     * @var TricksInterface|null
     */
    private $tricks;
    /**
     * @var CommentsInterface|null
     */
    private $comments;
    /**
     * @var PicturesInterface
     */
    private $pictures;
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
     * Users constructor.
     *
     * @param string                  $username
     * @param string                  $email
     * @param string                  $name
     * @param string                  $lastname
     * @param string                  $password
     * @param string                  $role
     * @param string                  $createdAt
     * @param PicturesInterface       $pictures
     * @param TricksInterface|null    $tricks
     * @param CommentsInterface|null  $comments
     */
    public function __construct(
        string $username,
        string $email,
        string $name,
        string $lastname,
        string $password,
        string $role,
        PicturesInterface $pictures,
        TricksInterface $tricks = null,
        CommentsInterface $comments = null
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
        $this->tricks = $tricks;
        $this->comments = $comments;
    }

    /**
     * @return TricksInterface
     */
    public function getTricks()
    {
        return $this->tricks;
    }

    /**
     * @return CommentsInterface
     */
    public function getComments()
    {
        return $this->comments;
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): ? int
    {
        return $this->createdAt;
    }

    /**
     * @return PicturesInterface
     */
    public function getPictures()
    {
        return $this->pictures;
    }
}
