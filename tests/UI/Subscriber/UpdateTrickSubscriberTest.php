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

  use App\Domain\Models\Movies;
  use App\UI\Subscriber\UpdateTrickSubscriber;
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
     * @var UpdateTrickSubscriber
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
    public function SetUp()
    {
      $this->updateTrickSubscriber = $this->createMock(UpdateTrickSubscriber::class);
      $this->formEvent = $this->createMock(FormEvent::class);
      $this->movies = $this->createMock(Movies::class);
      
      $this->imageFolder = '360.svg';
    }

    public function testInstanceOf()
    {
      $updateTrickSubscriber = new UpdateTrickSubscriber();
      static::assertInstanceOf(UpdateTrickSubscriber::class , $updateTrickSubscriber);
    }
  }
