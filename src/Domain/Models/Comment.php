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

use App\Domain\Models\Interfaces\CommentInterface;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Comment.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Comment implements CommentInterface
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
     * @var TrickInterface
     */
    private $trick;

    /**
     * @var UserInterface
     */
    private $user;
  
  /**
   * Comment constructor.
   *
   * @param string         $content
   * @param TrickInterface $trick
   * @param UserInterface  $user
   *
   * @throws \Exception
   */
    public function __construct(
      string $content,
      TrickInterface $trick,
      UserInterface $user = null
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->createdAt = time();
        $this->trick = $trick;
        $this->user = $user;
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
     * @return TrickInterface
     */
    public function getTrick()
    {
        return $this->trick;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
