<?php

namespace Tests\Actions;

use App\Actions\IndexAction;
use App\Responder\Interfaces\ResponderHomeInterface;
use PHPUnit\Framework\TestCase;


class IndexActionTest extends TestCase
{
    public function testIndexActionInstanceOf()
    {
        $indexAction = $this->createMock(IndexAction::class);
        static::assertInstanceOf(IndexAction::class, $indexAction);
    }

    public function testConstructor()
    {
        $responder = $this->createMock(ResponderHomeInterface::class);
        $constructResponder = new IndexAction($responder);
        static::assertInstanceOf(IndexAction::class, $constructResponder);
    }

    public function testInvoke()
    {

    }
}
