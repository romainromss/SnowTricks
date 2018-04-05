<?php
/**
 * Created by PhpStorm.
 * Users: romss
 * Date: 05/04/2018
 * Time: 09:25
 */

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Tricks;
use App\Domain\Models\Users;

interface CommentsInterface
{
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
    );

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getContent();

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @return mixed
     */
    public function getTrick();

    /**
     * @return mixed
     */
    public function getUser();
}