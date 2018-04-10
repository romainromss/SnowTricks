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

use App\Domain\Repository\TricksRepository;
use App\UI\Actions\HomeAction;
use App\UI\Actions\TricksDetailsAction;
use App\UI\Responder\ResponderHome;
use App\UI\Responder\ResponderTricksDetails;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class IndexActionTest
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class TricksDetailsActionTest extends TestCase
{
    /**
     *@test
     */
    public function testIndexActionInstanceOf()
    {
        $indexAction = $this->createMock(TricksDetailsAction::class);
        static::assertInstanceOf(TricksDetailsAction::class, $indexAction);
    }

    /**
     *@test
     */
    public function testConstructor()
    {
        $constructResponder = new TricksDetailsAction();
        static::assertInstanceOf(TricksDetailsAction::class, $constructResponder);
    }

    /**
     *@test
     */
    public function testInvoke()
    {
        $tricksRepository = $this->createMock(TricksRepository::class);
        $twig = $this->createMock(Environment::class);
        $slug = 'test';

        $tricksDetailsAction = new TricksDetailsAction();
        $responder = new ResponderTricksDetails($twig);

        static::assertInstanceOf(Response::class, $tricksDetailsAction($responder, $tricksRepository, $slug));
    }
}
