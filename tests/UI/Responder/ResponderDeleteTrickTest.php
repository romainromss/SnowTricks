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

namespace App\Tests\UI\Responder;

use App\UI\Responder\Interfaces\ResponderDeleteTrickInterface;
use App\UI\Responder\ResponderDeleteTrick;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ResponderDeleteTrickTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderDeleteTrickTest extends TestCase
{
	/**
	 * @var ResponderDeleteTrick
	 */
	private $responder;

	/**
	 * @var UrlGeneratorInterface
	 */
	private $urlGenerator;

	protected function setUp()
	{
		$this->responder = $this->createMock(ResponderDeleteTrick::class);
		$this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
		$this->urlGenerator->method('generate')->willReturn('index');

	}

	public function testResponderInstanceOf()
	{
		static::assertInstanceOf(ResponderDeleteTrick::class, $this->responder);
	}

	public function testResponderDeleteTrick(){
		$responder = new ResponderDeleteTrick($this->urlGenerator);

		static::assertInstanceOf(RedirectResponse::class, $responder());
	}
}
