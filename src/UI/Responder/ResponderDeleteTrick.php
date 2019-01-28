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

use App\UI\Responder\Interfaces\ResponderDeleteTrickInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ResponderDeleteTrick.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderDeleteTrick implements ResponderDeleteTrickInterface
{
	/**
	 * @var UrlGeneratorInterface
	 */
	private $urlGenerator;

	/**
	 * ResponderDeleteTrick constructor.
	 *
	 * @param UrlGeneratorInterface $urlGenerator
	 */
	public function __construct(UrlGeneratorInterface $urlGenerator)
	{
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * @return RedirectResponse
	 */
	public function __invoke()
	{
		return new RedirectResponse($this->urlGenerator->generate('index'));
	}
}
