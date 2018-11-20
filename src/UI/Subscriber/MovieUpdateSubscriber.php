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

namespace App\UI\Subscriber;

use App\Domain\DTO\MovieDTO;
use App\UI\Subscriber\Interfaces\movieUpdateSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class MovieUpdateSubscriber.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MovieUpdateSubscriber implements EventSubscriberInterface, movieUpdateSubscriberInterface
{
  
  /**
   * @var array
   */
  private $movies = [];
  
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents()
  {
    return [
      FormEvents::PRE_SET_DATA => 'onPreSetData'
    ];
  }
  
  /**
   * {@inheritdoc}
   */
  public function onPreSetData(FormEvent $formEvent)
  {
    $this->movies = $formEvent->getData();
    
    $movies = [];
    
    foreach ($formEvent->getData() as $movie) {
      $movies[] = new MovieDTO($movie->embed, $movie->legend);
      
    }
  }
}
