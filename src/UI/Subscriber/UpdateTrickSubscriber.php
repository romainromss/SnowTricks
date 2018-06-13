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

use App\UI\Subscriber\Interfaces\UpdateTrickSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class UpdateTrickSubscriber.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickSubscriber implements EventSubscriberInterface, UpdateTrickSubscriberInterface
{
	/**
	 * @var array
	 */
	private $pictures = [];

	/**
	 * @var array
	 */
	private $movies = [];

	/**
	 * @var string
	 */
	private $imageFolder;

	/**
	 * UpdateTrickSubscriber constructor.
	 *
	 * @param string $imageFolder
	 */
	public function __construct(string $imageFolder)
	{
		$this->imageFolder = $imageFolder;
	}

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
		$this->pictures = $event->getData()->pictures;

		foreach ($event->getData()->pictures as $picture) {
			$event->getData()->pictures[] = new File($this->imageFolder.$picture->getName());

			unset($event->getData()->pictures[array_search($picture, $event->getData()->pictures)]);
		}

		$this->movies = $event->getData()->movies;

		foreach ($event->getData()->movies as $movies) {
			$event->getData()->movies[] = is_string($movies->getEmbed());

			unset($event->getData()->movies[array_search($movies, $event->getData()->movies)]);
		}
	}
}
