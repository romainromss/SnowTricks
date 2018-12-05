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

use App\Domain\DTO\PictureDTO;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Services\GeneratorTokenService;
use App\Domain\Services\Interfaces\GeneratorTokenServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class User.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class User implements UserInterface
{
  /** @var UuidInterface */
  private $id;
  
  /** @var string */
  private $username;
  
  /** @var string */
  private $email;
  
  /** @var string  */
  private $email_token;
  
  /** @var string */
  private $name;
  
  /** @var string */
  private $lastname;
  
  /** @var string */
  private $password;
  
  /** @var string */
  private $role;
  
  /** @var string */
  private $createdAt;
  
  /** @var PictureDTO */
  public $picture;
  
  /** @var \ArrayAccess */
  private $trick;
  
  /** @var \ArrayAccess */
  private $comment;
  
  /**
   * User constructor.
   *
   * @param string           $username
   * @param string           $email
   * @param string           $email_token
   * @param string           $name
   * @param string           $lastname
   * @param string           $password
   * @param PictureInterface $picture
   *
   * @throws \Exception
   */
  public function __construct(
    string $username,
    string $email,
    string $emailToken,
    string $name,
    string $lastname,
    string $password,
    $picture = null
  ) {
    $this->id = Uuid::uuid4();
    $this->username = $username;
    $this->email = $email;
    $this->email_token = $emailToken;
    $this->name = $name;
    $this->lastname = $lastname;
    $this->password = $password;
    $this->role = 'ROLE_USER';
    $this->createdAt = time();
    $this->picture = $picture;
    $this->trick = new ArrayCollection($trick ?? []);
    $this->comment = new ArrayCollection($comment ?? []);
  }
  
  /**
   * @return UuidInterface
   */
  public function getId(): UuidInterface
  {
    return $this->id;
  }
  
  /**
   * @return string
   */
  public function getUsername(): string
  {
    return $this->username;
  }
  
  /**
   * @return string
   */
  public function getEmail(): string
  {
    return $this->email;
  }
  
  /**
   * @return string
   */
  public function getEmailToken(): string
  {
    return $this->email_token;
  }
  
  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }
  
  /**
   * @return string
   */
  public function getLastname(): string
  {
    return $this->lastname;
  }
  
  /**
   * @return string
   */
  public function getPassword(): string
  {
    return $this->password;
  }
  
  /**
   * @return string
   */
  public function getRole(): string
  {
    return $this->role;
  }
  
  /**
   * @return bool|\DateTime
   */
  public function getCreatedAt(): \DateTime
  {
    return \DateTime::createFromFormat('U', (string) $this->createdAt);
  }
  
  
  public function getPictures()
  {
    return $this->picture;
  }
  
  /**
   * @return \ArrayAccess
   */
  public function getTricks(): \ArrayAccess
  {
    return $this->trick;
  }
  
  /**
   * @return \ArrayAccess
   */
  public function getComments(): \ArrayAccess
  {
    return $this->comment;
  }
}
