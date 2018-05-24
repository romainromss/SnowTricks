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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class UpdateTrickSubscriber.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickSubscriber implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return [
			FormEvents::PRE_SET_DATA => 'onPreSetData'
		];
	}

	public function onPreSetData(FormEvent $events)
	{
		$form = $events->getForm();

		$form->add('pictures', FileType::class);
	}
}
