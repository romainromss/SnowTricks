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

use App\UI\Responder\ResponderDeletePicture;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ResponderDeletePictureTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderDeletePictureTest extends TestCase
{
  /**
   * @var ResponderDeletePicture
   */
  private $responder;
  
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  protected function setUp()
  {
    $this->responder = $this->createMock(ResponderDeletePicture::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->urlGenerator->method('generate')->willReturn('index');
    
  }
  
  public function testResponderInstanceOf()
  {
    static::assertInstanceOf(ResponderDeletePicture::class, $this->responder);
  }
  
  public function testResponderDeletePicture(){
    $responder = new ResponderDeletePicture($this->urlGenerator);
    
    static::assertInstanceOf(RedirectResponse::class, $responder());
  }
}
