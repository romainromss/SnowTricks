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

namespace App\Tests\UI\Responder;

use App\Domain\Repository\TricksRepository;
use App\UI\Form\Type\AddCommentType;
use App\UI\Responder\ResponderHome;
use App\UI\Responder\ResponderTricksDetails;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class ResponderHomeTest.
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
    public function testConstructResponderTricksDetails()
    {
        $twig = $this->createMock(Environment::class);
        $tricksRepository = $this->createMock(TricksRepository::class);
        $addCommentType = $this->createMock(FormInterface::class);
        $urlGenerator = $this->createMock(UrlGeneratorInterface::class);

        $responder = new ResponderTricksDetails($twig, $urlGenerator);
        static::assertInstanceOf(Response::class, $responder(['tricks' => $tricksRepository], $addCommentType));
    }
}
