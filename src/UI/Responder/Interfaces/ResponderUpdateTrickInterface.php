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

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Interface ResponderUpdateTrickInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface ResponderUpdateTrickInterface
{
	/**
	 * ResponderUpdateTrick constructor.
	 *
	 * @param Environment           $twig
	 * @param UrlGeneratorInterface $urlGenerator
	 */
	public function __construct(
		Environment $twig,
		UrlGeneratorInterface $urlGenerator
	);

	/**
	 * @param bool                $redirect
	 * @param null                $data
	 * @param FormInterface|null  $updateTricksType
	 *
	 * @return Response
	 */
	public function __invoke(
		$redirect = false,
		$data = null,
		FormInterface $updateTricksType = null
	):  Response;
}
