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

namespace Tests\Actions;

use App\Repository\TricksRepository;
use App\UI\Actions\HomeAction;
use App\UI\Responder\Interfaces\ResponderHomeInterface;
use App\UI\Responder\ResponderHome;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class IndexActionTest
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class IndexActionTest extends TestCase
{
    /**
     *@test
     */
    public function testIndexActionInstanceOf()
    {
        $indexAction = $this->createMock(HomeAction::class);
        static::assertInstanceOf(HomeAction::class, $indexAction);
    }

    /**
     *@test
     */
    public function testConstructor()
    {
        $responder = $this->createMock(ResponderHomeInterface::class);
        $constructResponder = new HomeAction($responder);
        static::assertInstanceOf(HomeAction::class, $constructResponder);
    }

    /**
     *@test
     */
    public function testInvoke()
    {
        $tricksRepository = $this->createMock(TricksRepository::class);
        $twig = $this->createMock(Environment::class);
        $request = $this->createMock(Request::class);

        $indexAction = new HomeAction();
        $responder = new ResponderHome($tricksRepository, $twig);
        static::assertInstanceOf(Response::class, $indexAction($responder, $request));
    }
}
