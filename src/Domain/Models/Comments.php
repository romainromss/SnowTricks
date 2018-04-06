<?php
declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\CommentsInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class Comments
 *
 * @package App\Domain\Models
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Comments implements CommentsInterface
{
    private $id;
    private $name;
    private $content;
    private $createdAt;
    private $trick;
    private $user;


    /**
     * Comments constructor.
     *
     * @param string $name
     * @param string $content
     * @param Tricks $trick
     * @param Users $user
     */
    public function __construct(
        string $name,
        string $content,
        Tricks $trick,
        Users $user
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->content = $content;
        $this->createdAt = time();
        $this->trick = $trick;
        $this->user = $user;
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
    public function getContent()
    {
        return $this->content;
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
    public function getTrick()
    {
        return $this->trick;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}
