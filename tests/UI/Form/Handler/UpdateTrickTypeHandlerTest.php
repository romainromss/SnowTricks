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

namespace App\Tests\UI\Form\Handler;

use App\Domain\Factory\MovieFactory;
use App\Domain\Factory\PictureFactory;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Repository\TrickRepository;
use App\Infra\Helper\UploaderHelper;
use App\UI\Form\Handler\Interfaces\UpdateTrickTypeHandlerInterface;
use App\UI\Form\Handler\UpdateTrickTypeHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


/**
 * Class UpdateTrickTypeHandlerTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickTypeHandlerTest extends TestCase
{
  /** @var MovieFactory */
  private $movieFactory;
  
  /** @var TrickRepository */
  private $tricksRepository;
  
  /** @var TokenStorageInterface */
  private $tokenstorage;
  
  /** @var FormInterface */
  private $formInterface;
  
  /** @var TrickInterface */
  private $tricks;
  
  /** @var PictureFactory */
  private $pictureFactory;
  
  /** @var UploaderHelper */
  private $uploaderHelper;
  
  protected function setUp()
  {
    $this->movieFactory = $this->createMock(MovieFactory::class);
    $this->pictureFactory = $this->createMock(PictureFactory::class);
    $this->tricksRepository = $this->createMock(TrickRepository::class);
    $this->uploaderHelper = $this->createMock(UploaderHelper::class);
    $this->tricks = $this->createMock(TrickInterface::class);
    $this->tokenstorage = $this->createMock(TokenStorageInterface::class);
    $token = $this->createMock(TokenInterface::class);
    
    $this->tokenstorage->method('getToken')->willReturn($token);
    $token->method('getUser')->willReturn($this->createMock(UserInterface::class));
    $this->formInterface = $this->createMock(FormInterface::class);
  }
  
  
  public function testConstruct()
  {
    $updateTrickTypeHandler = new UpdateTrickTypeHandler
    (
      $this->pictureFactory,
      $this->movieFactory,
      $this->tricksRepository,
      $this->tokenstorage,
      $this->uploaderHelper
    );
    
    static::assertInstanceOf(UpdateTrickTypeHandlerInterface::class, $updateTrickTypeHandler);
  }
  
  
  public function testHandleReturnFalse()
  {
    $updateTrickTypeHandler = new UpdateTrickTypeHandler(
      $this->pictureFactory,
      $this->movieFactory,
      $this->tricksRepository,
      $this->tokenstorage,
      $this->uploaderHelper
    );
    
    static::assertInstanceOf(
      UpdateTrickTypeHandlerInterface::class,
      $updateTrickTypeHandler
    );
    
    static::assertFalse(
      $updateTrickTypeHandler->handle($this->formInterface, $this->tricks)
    );
  }
  
  public function testHandleReturnTrue()
  {
    $updateTrickDTO = new UpdateTrickDTO(
      'name',
      'description',
      'group',
      ['pictures'],
      ['movies']
    );
    
    $this->formInterface->method('isValid')->willReturn(true);
    $this->formInterface->method('isSubmitted')->willReturn(true);
    $this->formInterface->method('getData')->willReturn($updateTrickDTO);
    
    
    $updateTrickTypeHandler = new UpdateTrickTypeHandler(
      $this->pictureFactory,
      $this->movieFactory,
      $this->tricksRepository,
      $this->tokenstorage,
      $this->uploaderHelper
    );
    
    $this->tricksRepository->update($this->tricks);
    
    static::assertInstanceOf(
      UpdateTrickTypeHandlerInterface::class,
      $updateTrickTypeHandler
    );
    
    static::assertTrue(
      $updateTrickTypeHandler->handle($this->formInterface, $this->tricks)
    );
  }
}
