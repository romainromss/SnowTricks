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
  
  use App\Domain\Models\Trick;
  use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
  use App\UI\Actions\DeleteTrickAction;
  use App\UI\Responder\Interfaces\ResponderDeleteTrickInterface;
  use App\UI\Responder\ResponderDeleteTrick;
  use PHPUnit\Framework\TestCase;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Generator\UrlGenerator;
  use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
  
  /**
   * Class DeleteTrickActionTest.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class DeleteTrickActionTest extends TestCase
  {
    /**
     * @var TrickRepositoryInterface
     */
    private $tricksRepository;
    
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    
    /**
     * @var Request
     */
    private $request;
    
    /**
     * @var ResponderDeleteTrickInterface
     */
    private $responderDeleteTrick;
    
    protected function setUp()
    {
      $this->tricksRepository = $this->createMock(TrickRepositoryInterface::class);
      $this->urlGenerator = $this->createMock(UrlGenerator::class);
      $this->urlGenerator->method('generate')->willReturn('/');
      $this->responderDeleteTrick = $this->createMock(ResponderDeleteTrickInterface::class);
      $request = Request::create('/delete/toto', 'GET');
      $this->request = $request->duplicate(null, null, ['slug' => 'toto']);
    }
    
    
    public function testConstruct()
    {
      $action = new DeleteTrickAction($this->tricksRepository);
      static::assertInstanceOf(DeleteTrickAction::class, $action);
    }
    
    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testDeleteTrickActionWithSlug()
    {
      $deleteTrickAction = new DeleteTrickAction($this->tricksRepository);
      $responderDeleteTrick = new ResponderDeleteTrick($this->urlGenerator);
      
      static::assertInstanceOf(Response::class, $deleteTrickAction(
        $responderDeleteTrick,
        $this->request
      ));
    }
  }
