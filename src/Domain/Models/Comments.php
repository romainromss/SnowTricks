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
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Comments.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Comments implements CommentsInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var TricksInterface
     */
    private $trick;

    /**
     * @var UsersInterface
     */
    private $users;


    /**
     * Comments constructor.
     *
     * @param string            $content
     * @param TricksInterface   $trick
     * @param UsersInterface    $users
     */
    public function __construct(
        string $content,
        TricksInterface $trick,
        UsersInterface $users
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->createdAt = time();
        $this->trick = $trick;
        $this->users = $users;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
    public function getUsers()
    {
        return $this->users;
    }
}
