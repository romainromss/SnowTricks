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

use App\Domain\Repository\TricksRepository;
use App\UI\Form\Type\UpdateTrickType;
use App\UI\Responder\ResponderUpdateTrick;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ResponderUpdateTrickTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderUpdateTrickTest extends TestCase
{
	/**
	 * @var Environment
	 */
	private $twig;

	/**
	 * @var TricksRepository
	 */
	private $tricksRepository;

	/**
	 * @var UpdateTrickType
	 */
	private $updateTrickType;

	/**
	 * @var UrlGeneratorInterface
	 */
	private $urlGenerator;

	public function setUp()
	{
		$this->twig = $this->createMock(Environment::class);
		$this->tricksRepository = $this->createMock(TricksRepository::class);
		$this->updateTrickType = $this->createMock(FormInterface::class);
		$this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
	}


	public function testResponderHomeInstanceOf()
	{
		$responder = $this->createMock(ResponderUpdateTrick::class);
		static::assertInstanceOf(ResponderUpdateTrick::class, $responder);
	}

	/**
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function testConstructResponderUpdateTrick()
	{
		$responder = new ResponderUpdateTrick($this->twig, $this->urlGenerator);
		static::assertInstanceOf(Response::class, $responder(false,['tricks' => $this->tricksRepository], $this->updateTrickType));
	}
}
