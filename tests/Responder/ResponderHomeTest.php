<?php

namespace Tests\Responder;


use App\Repository\TricksRepository;
use App\UI\Responder\ResponderHome;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ResponderHomeTest extends TestCase
{
    /**
     *@test
     */
    public function testResponderHomeInstanceOf()
    {
        $responder = $this->createMock(ResponderHome::class);
        static::assertInstanceOf(ResponderHome::class, $responder);
    }

    /**
     *@test
     */
    public function testConstructResponderHome()
    {
        $twig = $this->createMock(Environment::class);
        $trickRepository = $this->createMock(TricksRepository::class);

        $responder = new ResponderHome($trickRepository, $twig);
        static::assertInstanceOf(Response::class, $responder());
    }
}