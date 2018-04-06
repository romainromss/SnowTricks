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

/**
 * Interface UsersInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface UsersInterface
{
    public function getTricks();

    public function getComments();

    public function getId();

    public function getUsername();

    public function getEmail();

    public function getName();

    public function getLastname();

    public function getPassword();

    public function getRole();

    public function getCreatedAt();
}
