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

use App\UI\Subscriber\Interfaces\movieUpdateSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class MovieMovieUpdateSubscriber.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MovieMovieUpdateSubscriber implements EventSubscriberInterface, movieUpdateSubscriberInterface
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
  public function onPreSetData(FormEvent $event)
  {
    $this->movies = $event->getData();
    
    $data = [];
    
    foreach ($event->getData() as $movies) {
      $data[] = \is_string($movies->getEmbed()); $movies->getLegend()  ? $movies->getEmbed(): null;
      $event->setData($data);
      
      unset($event->getData()[array_search($movies, $event->getData())]);
    }
  }
}
