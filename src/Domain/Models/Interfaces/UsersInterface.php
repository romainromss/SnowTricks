<?php

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Comments;
use App\Domain\Models\Pictures;
use App\Domain\Models\Tricks;

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