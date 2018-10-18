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

namespace App\UI\Subscriber;

use App\Domain\DTO\PictureDTO;
use App\Infra\Helper\UploaderHelper;
use function Couchbase\defaultDecoder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;

class PictureUpdateSubscriber implements EventSubscriberInterface
{
  /**
   * @var array
   */
  private $pictures = [];
  
  /**
   * @var string
   */
  private $imageFolder;
  /**
   * @var UploaderHelper
   */
  private $uploaderHelper;
  
  /**
   * PicturesToFIleTransformer constructor.
   *
   * @param string                  $imageFolder
   * @param UploaderHelper $uploaderHelper
   */
  public function __construct(string $imageFolder, UploaderHelper $uploaderHelper)
  {
    $this->imageFolder = $imageFolder;
    $this->uploaderHelper = $uploaderHelper;
  }
  
  /**
   * @return array
   */
  public static function getSubscribedEvents()
  {
    return [
      FormEvents::PRE_SET_DATA => "onPreSetData",
      FormEvents::PRE_SUBMIT => "onPreSubmit",
      FormEvents::SUBMIT => "onSubmit"
    ];
  }
  
  /**
   * @param FormEvent $formEvent
   */
  public function onPreSetData(FormEvent $formEvent)
  {
    $this->pictures = $formEvent->getData()->pictures;
    
    $pictures = [];
    
    foreach ($formEvent->getData()->pictures as $picture) {
      $pictures[] = new PictureDTO(new File($this->imageFolder.$picture->getName()), $picture->getLegend(), $picture->isFirst());
    }
    
    $formEvent->getData()->pictures = $pictures;
  }
  
  /**
   * @param FormEvent $formEvent
   *
   * @throws \Exception
   */
  public function onPreSubmit(FormEvent $formEvent)
  {
    $values = $formEvent->getData()['pictures'];
    foreach(array_values($values) as $key => $value) {
      if(\is_null($value['file'])) {
        $value['file']['name'] = $this->pictures[$key]->getName();
        $value['legend'] = $this->pictures[$key]->getLegend();
        $value['file']['file'] = null;
        $values[$key] = $value;
      }
    }
  }
  
  
  public function onSubmit(FormEvent $formEvent)
  {
    dd($formEvent->getForm());
    if(\count($formEvent->getData()->pictures) > \count($this->pictures)) {
      foreach($this->pictures as $picture) {
        $formEvent->getData()->pictures[] = $picture;
      }
    }
  }
}
