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

use App\Domain\Repository\Interfaces\PictureRepositoryInterface;
use App\UI\Actions\DeletePictureAction;
use App\UI\Responder\Interfaces\ResponderDeletePictureInterface;
use App\UI\Responder\ResponderDeletePicture;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class DeletePictureActionTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class DeletePictureActionTest extends TestCase
{
  /**
   * @var PictureRepositoryInterface
   */
  private $pictureRepository;
  
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  /**
   * @var ResponderDeletePictureInterface
   */
  private $responderDeletePicture;
  
  /**
   * @var Request
   */
  private $request;
  
  public function setUp(){
    $this->pictureRepository = $this->createMock(PictureRepositoryInterface::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->urlGenerator->method('generate')->willReturn('/');
    $this->responderDeletePicture = $this->createMock(ResponderDeletePictureInterface::class);
    $request = Request::create('/delete/picture', 'GET');
    $this->request = $request->duplicate(null, null, ['id' => '0b433926-276e-44eb-8bae-2347aa71def5']);
  }
  
  public function testConstruct(){
    $deletePictureAction = new DeletePictureAction($this->pictureRepository);
    static::assertInstanceOf(DeletePictureAction::class, $deletePictureAction);
  }
  
  public function testDeletePictureActionWithId(){
    $deletePictureAction = new DeletePictureAction($this->pictureRepository);
    $responderDeletePicture = new ResponderDeletePicture($this->urlGenerator);
    
    static::assertInstanceOf(Response::class, $deletePictureAction(
      $responderDeletePicture,
      $this->request
    ));
  }
}
