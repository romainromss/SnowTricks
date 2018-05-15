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

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface ResponderAddTricksInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface ResponderAddTricksInterface
{
	public function __invoke(
		$redirect = false,
		$data = null,
		FormInterface $addTricksType = null
	):  Response;
}