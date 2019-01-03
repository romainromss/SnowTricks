<?php

declare(strict_types = 1);

/*
 * This file is part of the ${project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\PictureDTO;
use App\Domain\DTO\RegisterUserDTO;
use App\Domain\Factory\UserFactory;
use App\Domain\Models\Picture;
use App\Domain\Repository\UserRepository;
use App\Infra\Helper\UploaderHelper;
use App\UI\Form\Handler\RegisterUserHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class RegisterUserHandlerUnitTest extends TestCase
{
  /** @var EncoderFactoryInterface */
  private $encoderFactory;
  
  /** @var UserFactory */
  private $userFactory;
  
   /** @var RegisterUserDTO */
  private $registerUserDTO;
  
   /** @var UserRepository */
  private $userRepository;
  
  /** @var UploaderHelper */
  private $uploaderHelper;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  private $imageFolder;
  
  /** @var FormInterface */
  private $formInterface;
  
  protected function setUp()
  {
    $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
    $this->userFactory = $this->createMock(UserFactory::class);
    $this->registerUserDTO = $this->createMock(RegisterUserDTO::class);
    $this->userRepository = $this->createMock(UserRepository::class);
    $this->uploaderHelper = $this->createMock(UploaderHelper::class);
    $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
    $this->formInterface = $this->createMock(FormInterface::class);
    $this->imageFolder = __DIR__.'/../../../public/images/Upload/';
    
    $this->userFactory->method('create')->willReturn($this->registerUserDTO);
  }
  
  public function testConstruct()
  {
    $registerUserHandler = new RegisterUserHandler(
      $this->encoderFactory,
      $this->userFactory,
      $this->userRepository,
      $this->imageFolder,
      $this->uploaderHelper,
      $this->eventDispatcher
    );
    static::assertInstanceOf(RegisterUserHandler::class, $registerUserHandler);
  }
  
  /**
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function testHandleReturnFalse()
  {
    $registerUserHandler = new RegisterUserHandler(
      $this->encoderFactory,
      $this->userFactory,
      $this->userRepository,
      $this->imageFolder,
      $this->uploaderHelper,
      $this->eventDispatcher
    );
    
    static::assertFalse($registerUserHandler->handle($this->formInterface));
  }
  
  public function testHandleReturnTrue()
  {
    $picture = new  Picture(
      'name',
      'legend',
      false
    );
    
    $this->registerUserDTO->picture = $picture;
   
    
    $registerUserHandler = new RegisterUserHandler(
      $this->encoderFactory,
      $this->userFactory,
      $this->userRepository,
      $this->imageFolder,
      $this->uploaderHelper,
      $this->eventDispatcher
    );
    $this->formInterface->method('isValid')->willReturn(true);
    $this->formInterface->method('isSubmitted')->willReturn(true);
    $this->formInterface->method('getData')->willReturn($this->registerUserDTO);
    
    $this->userRepository->save($this->userFactory);
    static::assertTrue($registerUserHandler->handle($this->formInterface));
  }
}