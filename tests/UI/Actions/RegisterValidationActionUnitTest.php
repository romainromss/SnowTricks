<?php

declare(strict_types = 1);

/*
 * This file is part of the snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Actions;

use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Repository\UserRepository;
use App\UI\Actions\RegisterValidationAction;
use App\UI\Responder\ResponderRegisterValidation;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegisterValidationActionUnitTest extends TestCase
{
  /** @var UserRepository*/
  private $userRepository;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /** @var UsersInterface */
  private $user;
  
  /** @var Request */
  private $request;
  
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  protected function setUp()
  {
    $this->userRepository = $this->createMock(UserRepository::class);
    $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
    $this->user = $this->createMock(UsersInterface::class);
    $request = Request::create('/register-validation/emailToken', 'GET');
    $this->request = $request->duplicate(null, null, ['token' => 'emailToken']);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
  
  
    $this->user->method('getEmailToken')->willReturn('emailToken');
    $this->userRepository->method('getUserBytoken')->willReturn($this->user);
    $this->urlGenerator->method('generate')->willReturn('/');
  }
  
  public function testConstruct()
  {
    $constructResponder = new RegisterValidationAction(
      $this->userRepository,
      $this->eventDispatcher
    );
    static::assertInstanceOf(RegisterValidationAction::class, $constructResponder);
  }
  
  /**
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function testIfTokenNotFound()
  {
    $registerValidationAction = new RegisterValidationAction(
      $this->userRepository,
      $this->eventDispatcher
    );
    
    $responder = new ResponderRegisterValidation(
      $this->urlGenerator
    );
    static::assertInstanceOf(Response::class, $registerValidationAction($this->request, $responder));
  }
  
  /**
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function testIfTokenFound()
  {
    $registerValidationAction = new RegisterValidationAction(
      $this->userRepository,
      $this->eventDispatcher
    );
    
    $responder = new ResponderRegisterValidation(
      $this->urlGenerator
    );
    $this->request->attributes->get('token');
    
    static::assertInstanceOf(Response::class, $registerValidationAction($this->request, $responder));
  }
}