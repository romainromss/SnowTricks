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

namespace App\Tests\UI\Actions;

use App\Domain\Models\Interfaces\PicturesInterface;
use App\Domain\Models\Interfaces\TricksInterface;
use App\Domain\Models\Pictures;
use App\Domain\Repository\Interfaces\PicturesRepositoryInterface;
use App\Domain\Repository\Interfaces\TricksRepositoryInterface;
use App\UI\Actions\PictureFirstAction;
use App\UI\Responder\ResponderPictureFirst;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class PictureFirstActionTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PictureFirstActionTest extends TestCase
{
  /**
   * @var PicturesRepositoryInterface
   */
  private $pictureRepository = null;
  
  /**
   * @var TricksRepositoryInterface
   */
  private $trickRepository = null;
  
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  /**
   * @var Request
   */
  private $request;
  
  /**
   * @var PicturesInterface
   */
  private $picture;
  
  /**
   * @var TricksInterface
   */
  private $trick;
  
  protected function setUp()
  {
    $this->pictureRepository = $this->createMock(PicturesRepositoryInterface::class);
    $this->trickRepository = $this->createMock(TricksRepositoryInterface::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->picture = $this->createMock(PicturesInterface::class);
    $this->trick = $this->createMock(TricksInterface::class);
    $uuid = $this->createMock(UuidInterface::class);
    
    $this->urlGenerator->method('generate')->willReturn('/tricks/mute');
    $request = Request::create('/tricks/mute/picture-first/7fc91885-b82b-4922-a743-e7aac5d81717', 'GET');
    $this->request = $request->duplicate(null, null, ['id' => '7fc91885-b82b-4922-a743-e7aac5d81717']);
    $this->trickRepository->method('getBySlugWithPicturesId')->willReturn($this->trick);
    $this->trick->method('getPictures')->willReturn([$this->picture]);
    $this->picture->method('getId')->willReturn($uuid);
    $uuid->method('toString')->willReturn('7fc91885-b82b-4922-a743-e7aac5d81717');
  }
  
  public function testConstruct()
  {
    $action = new PictureFirstAction($this->pictureRepository, $this->trickRepository);
    $responderPictureFirst = new ResponderPictureFirst($this->urlGenerator);
    
    static::assertInstanceOf(Response::class, $action(
      $this->request,
      $responderPictureFirst
    ));
  }
}
