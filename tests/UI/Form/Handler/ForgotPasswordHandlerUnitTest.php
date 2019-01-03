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

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\ForgotPasswordDTO;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Repository\UserRepository;
use App\UI\Form\Handler\ForgotPasswordHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ForgotPasswordHandlerUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ForgotPasswordHandlerUnitTest extends TestCase
{
  /** @var UserRepository */
  private $userRepository;
  
  /** @var Environment */
  private $twig;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /** @var FormInterface */
  private $formInterface;
  
  private $usersInterface;
  
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  protected function setUp()
  {
    $this->userRepository = $this->createMock(UserRepository::class);
    $this->twig = $this->createMock(Environment::class);
    $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
    $this->formInterface = $this->createMock(FormInterface::class);
    $this->usersInterface = $this->createMock(UsersInterface::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    
    $this->usersInterface->method('passwordToken')->willReturn('token');
    $this->userRepository->method('getUserByUsernameAndEmail')->willReturn($this->usersInterface);
  }
  
  public function testConstruct()
  {
    $handler = new ForgotPasswordHandler(
      $this->userRepository,
      $this->twig,
      $this->eventDispatcher,
      $this->urlGenerator
    );
    static::assertInstanceOf(ForgotPasswordHandler::class, $handler);
  }
  
  public function testHandleReturnFalse()
  {
    $handler = new ForgotPasswordHandler(
      $this->userRepository,
      $this->twig,
      $this->eventDispatcher,
      $this->urlGenerator
    );
    static::assertFalse($handler->handle($this->formInterface));
  }
  
  /**
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function testHandleReturnTrue()
  {
    $user = new ForgotPasswordDTO(
      'username',
      'email@email.fr'
    );
    
    $handler = new ForgotPasswordHandler(
      $this->userRepository,
      $this->twig,
      $this->eventDispatcher,
      $this->urlGenerator
    );
  
    $this->formInterface->method('isValid')->willReturn(true);
    $this->formInterface->method('isSubmitted')->willReturn(true);
    $this->formInterface->method('getData')->willReturn($user);
  
    static::assertTrue(
      $handler->handle($this->formInterface)
    );
  }
  
  
}