<?php

declare(strict_types = 1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\UI\Responder;

use App\UI\Responder\ResponderPictureFirst;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ResponderPictureFirstTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderPictureFirstTest extends TestCase
{
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  /**
   * @var ResponderPictureFirst
   */
  private $responder;
  
  /**
   * @var Request
   */
  private $request;
  
  public function setUp()
  {
    $this->responder = $this->createMock(ResponderPictureFirst::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->urlGenerator->method('generate')->willReturn('/tricks/mute');
    $request = Request::create('/tricks', 'GET');
    $this->request = $request->duplicate(null, null, ['slug' => 'mute']);
  }
  
  public function testIsInstanceOf()
  {
    static::assertInstanceOf(ResponderPictureFirst::class, $this->responder);
  }
  
  public function testResponderPictureFisrt()
  {
    $this->request->attributes->get ('slug');
    
    $responder = new ResponderPictureFirst($this->urlGenerator);
    static::assertInstanceOf(RedirectResponse::class, $responder($this->request)
    );
  }
}
