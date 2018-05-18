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

namespace App\Tests\UI\Responder;
use App\Domain\Repository\TricksRepository;
use App\UI\Form\Handler\Intefaces\AddTricksTypeHandlerInterface;
use App\UI\Responder\ResponderAddTricks;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;


/**
 * Class ResponderAddTricksTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderAddTricksTest extends TestCase
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
	 * @var AddTricksTypeHandlerInterface
	 */
	private $addTricksType;
	/**
	 * @var UrlGeneratorInterface
	 */
	private $urlGenerator;

	public function setUp()
	{
		$this->twig = $this->createMock(Environment::class);
		$this->tricksRepository = $this->createMock(TricksRepository::class);
		$this->addTricksType = $this->createMock(FormInterface::class);
		$this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
	}


	public function testResponderHomeInstanceOf()
	{
		$responder = $this->createMock(ResponderAddTricks::class);
		static::assertInstanceOf(ResponderAddTricks::class, $responder);
	}

	/**
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
	public function testConstructResponderAddTricks()
	{
		$responder = new ResponderAddTricks($this->twig, $this->urlGenerator);
		static::assertInstanceOf(Response::class, $responder(false,['tricks' => $this->tricksRepository], $this->addTricksType));
	}
}