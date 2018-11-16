<?php

declare(strict_types=1);

/*
 * This file is part of the ${project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Handler\Interfaces;


use App\Domain\Models\Interfaces\CommentInterface;
use App\Domain\Models\Interfaces\MovieInterface;
use App\Domain\Models\Interfaces\PictureInterface;
use App\Domain\Models\Interfaces\UserInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Interfaces AddTrickTypeHandlerInterface.
 *
 * @author  Romain Bayette <romain.romss@gmail.com>
 */
interface AddTrickTypeHandlerInterface
{
	/**
	 * @param FormInterface      $form
	 *
	 * @return bool
	 *
	 */
	public function handle(
		FormInterface $form
	):  bool;
}