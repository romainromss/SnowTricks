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

use App\Domain\Repository\TrickRepository;
use App\UI\Actions\HomeAction;
use App\UI\Responder\ResponderHome;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class HomeActionTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class HomeActionTest extends TestCase
{
    /**
     * @var TrickRepository
     */
    private $tricksRepository;
    /**
     * @var Environment
     */
    private $twig;

    protected function setUp()
    {
        $this->tricksRepository = $this->createMock(TrickRepository::class);
        $this->twig = $this->createMock(Environment::class);
    }
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
        $constructResponder = new HomeAction($this->tricksRepository);
        static::assertInstanceOf(HomeAction::class, $constructResponder);
    }

    /**
     *@test
     */
    public function testInvoke()
    {
        $indexAction = new HomeAction($this->tricksRepository);
        $responder = new ResponderHome($this->twig);

        static::assertInstanceOf(Response::class, $indexAction($responder));
    }
}
