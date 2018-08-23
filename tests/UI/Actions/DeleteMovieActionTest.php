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

use App\Domain\Repository\Interfaces\MoviesRepositoryInterface;
use App\UI\Actions\DeleteMovieAction;
use App\UI\Responder\ResponderDeleteMovie;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class DeleteMovieActionTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class DeleteMovieActionTest extends TestCase
{
  /**
   * @var MoviesRepositoryInterface
   */
  private $movieRepository;
  
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  /**
   * @var Request
   */
  private $request;
  
  public function setUp(){
    $this->movieRepository = $this->createMOck(MoviesRepositoryInterface::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->urlGenerator->method('generate')->willReturn('/');
    $request = Request::create('/delete/movie/e176534a-48bd-4437-be49-f7742862f2e4', 'GET');
    $this->request = $request->duplicate(null, null, ['id' => 'e176534a-48bd-4437-be49-f7742862f2e4']);
  }
  
  public function testConstruct(){
    $deleteMovieAction = new DeleteMovieAction($this->movieRepository);
    static::assertInstanceOf(DeleteMovieAction::class, $deleteMovieAction);
  }
  
  /**
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function testDeleteMovieActionWithId(){
    $deleteMovieAction = new DeleteMovieAction($this->movieRepository);
    $responderDeleteMovie = new ResponderDeleteMovie($this->urlGenerator);
    
    static::assertInstanceOf(Response::class, $deleteMovieAction(
      $responderDeleteMovie,
      $this->request
    ));
  }
}
