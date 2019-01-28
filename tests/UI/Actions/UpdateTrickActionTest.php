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

use App\Domain\DTO\MovieDTO;
use App\Domain\DTO\PictureDTO;
use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Interfaces\TrickInterface;
use App\Domain\Models\Picture;
use App\Domain\Repository\TrickRepository;
use App\UI\Actions\UpdateTrickAction;
use App\UI\Form\Handler\UpdateTrickTypeHandler;
use App\UI\Responder\ResponderUpdateTrick;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class UpdateTrickActionTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickActionTest extends TestCase
{
  /**
   * @var FormFactoryInterface
   */
  private $formFactory;
  
  /**
   * @var Environment
   */
  private $twig;
  
  /**
   * @var UrlGeneratorInterface
   */
  private $urlGenerator;
  
  /**
   * @var Request
   */
  private $request;
  
  /**
   * @var UpdateTrickTypeHandler
   */
  private $updateTrickTypeHandler;
  
  /**
   * @var TrickRepository
   */
  private $tricksRepository;
  
  /**
   * @var TrickInterface
   */
  private $tricks;
  
  /**
   * @var Collection
   */
  private $collection;
  
  /** @var string */
  private $imageFolder;

  private $picture;
  
  protected function setUp()
  {
    $this->formFactory = $this->createMock(FormFactoryInterface::class);
    $this->twig = $this->createMock(Environment::class);
    $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
    $this->picture = $this->createMock(Picture::class);
    $this->request = Request::create('/trick/details/mute', 'POST');
    $this->updateTrickTypeHandler = $this->createMock(UpdateTrickTypeHandler::class);
    $this->tricksRepository = $this->createMock(TrickRepository::class);
    $this->tricks = $this->createMock(TrickInterface::class);
    $this->collection = $this->createMock(Collection::class);
    $formInterface = $this->createMock(FormInterface::class);
    $this->imageFolder = __DIR__.'/../../../public/images/Upload/';
    
    $formInterface->method('handleRequest')->willReturnSelf();
    $this->formFactory->method('create')->willReturn($formInterface);
    $this->collection->method('toArray')->willReturn([]);
    $this->urlGenerator->method('generate')->willReturn('/');
    $this->tricks->method('getPictures')->willReturn($this->collection);
    $this->tricks->method('getMovies')->willReturn($this->collection);
    $this->tricksRepository->method('getBySlug')->willReturn($this->tricks);
    $this->picture->method('getName')->willReturn('540.svg');
  }
  
  
  public function testConstructor()
  {
    $constructResponder = new UpdateTrickAction(
      $this->formFactory,
      $this->updateTrickTypeHandler,
      $this->tricksRepository,
      $this->imageFolder
    );
    
    
    static::assertInstanceOf(
      UpdateTrickAction::class,
      $constructResponder
    );
  }
  
  
  /**
   * @return ResponderUpdateTrick
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function testReturnFalse()
  {
    $updateTrickAction = new UpdateTrickAction(
      $this->formFactory,
      $this->updateTrickTypeHandler,
      $this->tricksRepository,
      $this->imageFolder
    );
    
    $responder = new ResponderUpdateTrick(
      $this->twig,
      $this->urlGenerator
    );
    
    $this->updateTrickTypeHandler->method('handle')->willReturn(false);
    
    static::assertInstanceOf(Response::class, $updateTrickAction(
      $responder,
      $this->request
    ));
    return $responder;
    
  }
  
  /**
   * @return Response
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function testReturnTrue()
  {
    $updateTrickAction = new UpdateTrickAction(
      $this->formFactory,
      $this->updateTrickTypeHandler,
      $this->tricksRepository,
      $this->imageFolder
    );
  
    $pictureDTO = $this->getMockBuilder(PictureDTO::class)->disableOriginalConstructor()->getMock();
    $pictureDTO->file = $this->createMock(UploadedFile::class);
    $pictureDTO->legend = 'legend';
    
    $movieDTO[] = $this->createMock(MovieDTO::class);
    
     new UploadedFile($this->imageFolder.$this->picture->getName(), $this->picture->getName());

		$responder = new ResponderUpdateTrick(
          $this->twig,
          $this->urlGenerator
        );

		$this->updateTrickTypeHandler->method('handle')->willReturn(true);

		static::assertInstanceOf(Response::class, $updateTrickAction(
          $responder,
          $this->request
        ));
		return $responder(true);
	}
}
