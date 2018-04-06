<?php
declare(strict_types=1);

namespace App\Domain\Models\Interfaces;

/**
 * Interface UsersInterface
 *
 * @package App\Domain\Models\Interfaces
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
