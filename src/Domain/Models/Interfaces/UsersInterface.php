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

namespace App\Domain\Models\Interfaces;
use Ramsey\Uuid\UuidInterface;

/**
 * Interface UsersInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface UsersInterface
{
    /**
     * @return TricksInterface
     */
    public function getTricks();

    /**
     * @return CommentsInterface
     */
    public function getComments();

    /**
     * @return UuidInterface
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getLastname();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return string
     */
    public function getRole();

    /**
     * @return PicturesInterface
     */
    public function getPictures();

    /**
     * @return string
     */
    public function getCreatedAt();
}
