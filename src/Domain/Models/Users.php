<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\UserInterface;
use Ramsey\Uuid\Uuid;

class User implements UserInterface
{
    private $tricks;
    private $comments;
    private $pictures;
    private $id;
    private $username;
    private $email;
    private $name;
    private $lastname;
    private $password;
    private $role;
    private $createdAt;

    /**
     * Users constructor.
     *
     * @param string $username
     * @param string $email
     * @param string $name
     * @param string $lastname
     * @param string $password
     * @param string $role
     * @param Tricks|null $tricks
     * @param Pictures $pictures
     * @param Comments|null $comments
     */
    public function __construct(
        string $username,
        string $email,
        string $name,
        string $lastname,
        string $password,
        string $role,
        Pictures $pictures,
        Tricks $tricks = null,
        Comments $comments = null
    ) {
        $this->id = Uuid::uuid4();
        $this->username = $username;
        $this->email = $email;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->role = $role;
        $this->pictures = $pictures;
        $this->tricks = $tricks;
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getTricks()
    {
        return $this->tricks;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
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
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}
