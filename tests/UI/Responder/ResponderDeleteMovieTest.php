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

use App\UI\Responder\ResponderDeleteMovie;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ResponderDeleteMovieTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderDeleteMovieTest extends TestCase
{
  /**
   * @var ResponderDeleteMovie
   */
  private $responder;
  
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  protected function setUp(){
    $this->responder = $this->createMOck(ResponderDeleteMovie::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->urlGenerator->method('generate')->willReturn('/');
  }
  
  public function testResponderInstanceOf(){
    static::assertInstanceOf(ResponderDeleteMovie::class, $this->responder);
  }
  
  public function testResponderDeleteMovie(){
    $responder = new ResponderDeleteMovie($this->urlGenerator);
    
    static::assertInstanceOf(RedirectResponse::class, $responder());
  }
}
