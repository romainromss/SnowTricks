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

  namespace App\Tests\UI\Subscriber;

  use App\Domain\DTO\MovieDTO;
  use App\Domain\DTO\UpdateTrickDTO;
  use App\Domain\Models\Interfaces\MovieInterface;
  use App\Domain\Models\Movie;
  use App\UI\Subscriber\MovieUpdateSubscriber;
  use PHPUnit\Framework\TestCase;
  use Symfony\Component\Form\FormEvent;

  /**
   * Class UpdateTrickSubscriberTest.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class UpdateTrickSubscriberTest extends TestCase
  {
    /**
     * @var array
     */
    private $movies = [];

    /**
     * @var string
     */
    private $imageFolder;

    /**
     * @var MovieUpdateSubscriber
     */
    private $updateTrickSubscriber;
  
    /**
     * @var FormEvent
     */
    private $formEvent;

    /**
     * UpdateTrickSubscriberTest constructor.
     *
     */
    protected function setUp()
    {
      $this->updateTrickSubscriber = $this->createMock(MovieUpdateSubscriber::class);
      $this->formEvent = $this->createMock(FormEvent::class);
      $this->movies = $this->createMock(Movie::class);
      
      $this->imageFolder = '360.svg';
    }

    public function testInstanceOf()
    {
      $updateTrickSubscriber = new MovieUpdateSubscriber();
      static::assertInstanceOf(MovieUpdateSubscriber::class , $updateTrickSubscriber);
    }
  
    
    public function testDataAreSet()
    {
      $movieMock = $this->createMock(MovieInterface::class);
      $movies[] = $movieMock;
      $movieDTOMock = new UpdateTrickDTO('name','','',[],$movies);
      $this->formEvent->method('getData')->willReturn($movieDTOMock);
      
      $updateTrickSubscriber = new MovieUpdateSubscriber();
      $updateTrickSubscriber->onPreSetData($this->formEvent);
      static::assertNotNull($movieDTOMock->movies);
      static::assertCount(1, $movieDTOMock->movies);
    }
  }
