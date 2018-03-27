<?php

namespace Tests\Responder;

use App\Repository\TricksRepository;
use App\Responder\ResponderHome;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class ResponderHomeTest extends TestCase
{
    public function testResponderHomeInstanceOf()
    {
        $responder = $this->createMock(ResponderHome::class);
        static::assertInstanceOf(ResponderHome::class, $responder);
    }

    public function testConstructResponderHome()
    {
        $twig = $this->createMock(Environment::class);
        $trickRepository = $this->createMock(TricksRepository::class);

        new ResponderHome($trickRepository, $twig);
    }
}