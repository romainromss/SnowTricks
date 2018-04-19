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

use App\Domain\Repository\TricksRepository;
use App\UI\Actions\HomeAction;
use App\UI\Responder\ResponderHome;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class IndexActionTest.
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
        $constructResponder = new HomeAction();
        static::assertInstanceOf(HomeAction::class, $constructResponder);
    }

    /**
     *@test
     */
    public function testInvoke()
    {
        $tricksRepository = $this->createMock(TricksRepository::class);
        $twig = $this->createMock(Environment::class);

        $indexAction = new HomeAction();
        $responder = new ResponderHome($twig);

        static::assertInstanceOf(Response::class, $indexAction($responder, $tricksRepository));
    }
}
