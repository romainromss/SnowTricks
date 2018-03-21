<?php

namespace App\Tests;

use App\Actions\IndexAction;
use App\Entity\Tricks;
use App\Repository\TricksRepository;
use Sensio\Bundle\FrameworkExtraBundle\Request\ArgumentValueResolver\Psr7ServerRequestResolver;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Twig_Environment;
use Twig_Loader_Filesystem;

class IndexActionTest extends TestCase
{
    private $twig;
    private $trick;

    public function setUp()
    {
        parent::setUp();

        $twigLoader = new Twig_Loader_Filesystem(__DIR__.'/views');
        $this->twig = new Twig_Environment($twigLoader, []);

        $this->trick = new Tricks();
        $this->trick->setDescription("TestDescription");
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testReturnResponse()
    {
        $action = new IndexAction($this->twig);
        $response = $action(Request::create('/'), $this->getTrickRepositoryMockAllWithPictures());

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame("TestDescription", $response->getContent());
    }

    private function getTrickRepositoryMockAllWithPictures()
    {
        $trickRepository = $this->getMockBuilder(TricksRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['getAllWithPictures'])
            ->getMock();

        $trickRepository->expects($this->once())
            ->method('getAllWithPictures')
            ->willReturn([
                $this->trick
            ]);

        return $trickRepository;
    }
}



