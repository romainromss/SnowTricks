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

use App\Domain\Repository\TrickRepository;
use App\UI\Form\Handler\Interfaces\AddCommentTypeHandlerInterface;
use App\UI\Responder\ResponderTrickDetails;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ResponderHomeTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderTrickDetailsActionTest extends TestCase
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var TrickRepository
     */
    private $tricksRepository;

    /**
     * @var AddCommentTypeHandlerInterface
     */
    private $addCommentType;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    protected function setUp()
    {
        $this->twig = $this->createMock(Environment::class);
        $this->tricksRepository = $this->createMock(TrickRepository::class);
        $this->addCommentType = $this->createMock(FormInterface::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    }

    public function testResponderHomeInstanceOf()
    {
        $responder = $this->createMock(ResponderTrickDetails::class);
        static::assertInstanceOf(ResponderTrickDetails::class, $responder);
    }

	/**
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Syntax
	 */
    public function testConstructResponderTricksDetails()
    {
        $responder = new ResponderTrickDetails($this->twig, $this->urlGenerator);
        static::assertInstanceOf(Response::class, $responder(false,['tricks' => $this->tricksRepository], $this->addCommentType));
    }
}
