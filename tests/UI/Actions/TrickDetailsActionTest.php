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

namespace App\Tests\UI\Actions;

use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Repository\TricksRepository;
use App\UI\Actions\TrickDetailsAction;
use App\UI\Form\Handler\Intefaces\AddCommentTypeHandlerInterface;
use App\UI\Responder\Interfaces\ResponderTrickDetailsInterface;
use App\UI\Responder\ResponderTrickDetails;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class HomeActionTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TrickDetailsActionTest extends KernelTestCase
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var AddCommentTypeHandlerInterface
     */
    private $addCommentTypeHandler;
    /**
     * @var TricksRepository
     */
    private $tricksRepository;
    /**
     * @var TricksInterface
     */
    private $tricks;

    protected function setUp()
    {
        static::bootKernel();
        $this->formFactory = static::$kernel->getContainer()->get('form.factory');
        $this->twig = $this->createMock(Environment::class);
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->urlGenerator->method('generate')->willReturn('/');
        $this->request = Request::create('/tricks/details/mute', 'POST');
        $this->addCommentTypeHandler = $this->createMock(AddCommentTypeHandlerInterface::class);
        $this->tricksRepository = $this->createMock(TricksRepository::class);
        $this->tricks = $this->createMock(TricksInterface::class);
        $this->tricksRepository->method('getBySlug')->willReturn($this->tricks);
    }


    public function testConstructor()
    {
        $constructResponder = new TrickDetailsAction($this->formFactory, $this->addCommentTypeHandler, $this->tricksRepository);
        static::assertInstanceOf(TrickDetailsAction::class, $constructResponder);
    }


    /**
     * @return ResponderTrickDetails
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testReturnFalse()
    {
        $tricksDetailsAction = new TrickDetailsAction($this->formFactory, $this->addCommentTypeHandler, $this->tricksRepository);
        $responder = new ResponderTrickDetails($this->twig, $this->urlGenerator);

        $this->addCommentTypeHandler->method('handle')->willReturn(false);

        static::assertInstanceOf(Response::class, $tricksDetailsAction(
            $responder,
            $this->request
        ));
        return $responder;

    }

    /**
     * @return Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testReturnTrue()
    {
        $tricksDetailsAction = new TrickDetailsAction($this->formFactory, $this->addCommentTypeHandler, $this->tricksRepository);
        $responder = new ResponderTrickDetails($this->twig, $this->urlGenerator);

        $this->addCommentTypeHandler->method('handle')->willReturn(true);

        static::assertInstanceOf(Response::class, $tricksDetailsAction(
            $responder,
            $this->request
        ));

    }
}
