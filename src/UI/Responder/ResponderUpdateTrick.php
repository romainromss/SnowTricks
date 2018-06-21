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

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\ResponderUpdateTrickInterface;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ResponderUpdateTrick.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderUpdateTrick implements ResponderUpdateTrickInterface
{
	/**
	 * @var Environment
	 */
	private $twig;
	/**
	 * @var UrlGeneratorInterface
	 */
	private $urlGenerator;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(
		Environment $twig,
		UrlGeneratorInterface $urlGenerator
	) {
		$this->twig = $twig;
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 *{@inheritdoc}
	 *
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function __invoke(
		$redirect = false,
		$data = null,
		FormInterface $updateTricksType = null
	):  Response {
	  
		$response = $redirect
			?  new RedirectResponse($this->urlGenerator->generate('index'))
			:  new Response($this->twig->render('tricks/updateTricks.html.twig', $data));

		return $response;
	}
}
