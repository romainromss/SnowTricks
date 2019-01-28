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

use App\Domain\Models\User;
use App\Domain\Repository\UserRepository;
use App\UI\Form\Handler\ValidateForgotPasswordHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

/**
 * Class ValidateForgotPasswordHandlerUnitTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ValidateForgotPasswordHandlerUnitTest extends TestCase
{
  /** @var UserRepository */
  private $userRepository;
  
  /** @var EncoderFactory */
  private $encoderFactory;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /** @var FormInterface */
  private $formInterface;
  
  /** @var User */
  private $user;
  
  protected function setUp()
  {
    $this->userRepository = $this->createMock(UserRepository::class);
    $this->user = $this->createMock(User::class);
    $this->encoderFactory = $this->createMock(EncoderFactory::class);
    $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
    $this->formInterface = $this->createMock(FormInterface::class);
  }
  
  public function testConstruct()
  {
    $validateForgotPasswordHandler = new ValidateForgotPasswordHandler(
      $this->userRepository,
      $this->encoderFactory,
      $this->eventDispatcher
    );
    static::assertInstanceOf(ValidateForgotPasswordHandler::class, $validateForgotPasswordHandler);
  }
  
  public function testHandleReturnFalse()
  {
    $validateForgotPasswordHandler = new ValidateForgotPasswordHandler(
      $this->userRepository,
      $this->encoderFactory,
      $this->eventDispatcher
    );
    static::assertFalse($validateForgotPasswordHandler->handle($this->formInterface, $this->user));
  }
  
  public function testHandleReturnTrue()
  {
    $validateForgotPasswordHandler = new ValidateForgotPasswordHandler(
      $this->userRepository,
      $this->encoderFactory,
      $this->eventDispatcher
    );
    
    $user = new User(
      'username',
      'email',
      '',
      'name',
      'lastname',
      'password'
    );
    
    $encoder  = $this->encoderFactory->getEncoder($user);
    $user->passwordReset($encoder->encodePassword($user->getPassword(), ''));
    
    $this->formInterface->method('isValid')->willReturn(true);
    $this->formInterface->method('isSubmitted')->willReturn(true);
    $this->formInterface->method('getData')->willReturn($this->user);
    $this->userRepository->flush();
    static::assertTrue($validateForgotPasswordHandler->handle($this->formInterface, $this->user));
  }
}
