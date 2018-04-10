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

namespace Tests\Responder;

use App\Domain\Repository\TricksRepository;
use App\UI\Responder\ResponderHome;
use App\UI\Responder\ResponderTricksDetails;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class ResponderHomeTest
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderTricksDetailsActionTest extends TestCase
{
    /**
     *@test
     */
    public function testResponderHomeInstanceOf()
    {
        $responder = $this->createMock(ResponderTricksDetails::class);
        static::assertInstanceOf(ResponderTricksDetails::class, $responder);
    }

    /**
     *@test
     */
    public function testConstructResponderHome()
    {
        $twig = $this->createMock(Environment::class);
        $tricksRepository = $this->createMock(TricksRepository::class);

        $responder = new ResponderTricksDetails($twig);
        static::assertInstanceOf(Response::class, $responder(['tricks' => $tricksRepository]));
    }
}
