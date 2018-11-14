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
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
   * @var Filesystem
   */
  private $filesystem;
  
  /**
   * PicturesToFIleTransformer constructor.
   *
   * @param string         $imageFolder
   * @param UploaderHelper $uploaderHelper
   * @param Filesystem     $filesystem
   */
  public function __construct(
    string $imageFolder,
    UploaderHelper $uploaderHelper,
    Filesystem $filesystem
  ) {
    $this->imageFolder = $imageFolder;
    $this->uploaderHelper = $uploaderHelper;
    $this->filesystem = $filesystem;
  }
  
  /**
   * @return array
   */
  public static function getSubscribedEvents()
  {
    return [
      FormEvents::PRE_SET_DATA => "onPreSetData",
    ];
  }
  
  /**
   * @param FormEvent $formEvent
   */
  public function onPreSetData(FormEvent $formEvent)
  {
    $this->pictures = $formEvent->getData();

    $pictures = [];

    foreach ($formEvent->getData() as $picture) {
      $pictures[] = new PictureDTO( new File($this->imageFolder.$picture->getName()), $picture->getLegend(), $picture->isFirst());
    }
    
  }
}
