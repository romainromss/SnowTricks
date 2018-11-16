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
use App\Domain\Factory\TrickFactory;
use App\Domain\DTO\AddTrickDTO;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Repository\TrickRepository;
use App\Infra\Helper\UploaderHelper;
use App\UI\Form\Handler\AddTrickTypeHandler;
use App\UI\Form\Handler\Interfaces\AddTrickTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class AddTricksTypeHandlerTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickTypeHandlerTest extends TestCase
{
  /**
   * @var TrickFactory
   */
  private $trickFactory;
  
  /**
   * @var TrickRepository
   */
  private $tricksRepository;
  
  /**
   * @var TokenStorageInterface
   */
  private $tokenstorage;
  
  /**
   * @var FormInterface
   */
  private $formInterface;
  
  /**
   * @var PictureFactory
   */
  private $pictureFactory;
  
  /**
   * @var MovieFactory
   */
  private $movieFactory;
  
  /**
   * @var UploaderHelper
   */
  private $uploaderHelper;
  
  protected function setUp()
  {
    $this->trickFactory = $this->createMock(TrickFactory::class);
    $this->pictureFactory = $this->createMock(PictureFactory::class);
    $this->movieFactory = $this->createMock(MovieFactory::class);
    $this->uploaderHelper = $this->createMock(UploaderHelper::class);
    $this->tricksRepository = $this->createMock(TrickRepository::class);
    $this->tokenstorage = $this->createMock(TokenStorageInterface::class);
    $token = $this->createMock(TokenInterface::class);
    $this->tokenstorage->method('getToken')->willReturn($token);
    $token->method('getUser')->willReturn($this->createMock(UserInterface::class));
    $this->formInterface = $this->createMock(FormInterface::class);
  }
  
  
  public function testConstruct()
  {
    $addTricksTypeHandler = new AddTrickTypeHandler(
      $this->trickFactory,
      $this->pictureFactory,
      $this->movieFactory,
      $this->tricksRepository,
      $this->tokenstorage,
      $this->uploaderHelper
    );
    static::assertInstanceOf(AddTrickTypeHandlerInterface::class, $addTricksTypeHandler);
  }
  
  /**
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function testHandleReturnFalse()
  {
    $addTricksTypeHandler = new AddTrickTypeHandler(
      $this->trickFactory,
      $this->pictureFactory,
      $this->movieFactory,
      $this->tricksRepository,
      $this->tokenstorage,
      $this->uploaderHelper
    );
    
    static::assertInstanceOf(
      AddTrickTypeHandlerInterface::class,
      $addTricksTypeHandler
    );
    
    static::assertFalse(
      $addTricksTypeHandler->handle($this->formInterface)
    );
  }
  
  
  /**
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function testHandleReturnTrue()
  {
    $addTrickDTO = new AddTrickDTO(
      'name',
      'description',
      'group',
      ['pictures'],
      ['movies']
    );
    
    $this->formInterface->method('isValid')->willReturn(true);
    $this->formInterface->method('isSubmitted')->willReturn(true);
    $this->formInterface->method('getData')->willReturn($addTrickDTO);
  
  
    $addTricksTypeHandler = new AddTrickTypeHandler(
      $this->trickFactory,
      $this->pictureFactory,
      $this->movieFactory,
      $this->tricksRepository,
      $this->tokenstorage,
      $this->uploaderHelper
    );
    
    $this->tricksRepository->save($tricks = $this->createMock(TrickFactory::class));
    
    static::assertInstanceOf(
      AddTrickTypeHandlerInterface::class,
      $addTricksTypeHandler
    );
    
    static::assertTrue(
      $addTricksTypeHandler->handle($this->formInterface)
    );
  }
}
