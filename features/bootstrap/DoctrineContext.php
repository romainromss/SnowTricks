<?php

declare(strict_types = 1);

/*
 * This file is part of the snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Domain\Models\Trick;
use App\Domain\Models\User;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class DoctrineContext.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class DoctrineContext extends MinkContext
{
  /** @var EntityManagerInterface */
  private $entityManager;
  
  /** @var UserPasswordEncoderInterface */
  private $passwordEncoder;
  
  /**
   * DoctrineContext constructor.
   *
   * @param EntityManagerInterface       $entityManager
   * @param UserPasswordEncoderInterface $passwordEncoder
   */
  public function __construct(
    EntityManagerInterface $entityManager,
    UserPasswordEncoderInterface $passwordEncoder
  ) {
    $this->entityManager = $entityManager;
    $this->passwordEncoder = $passwordEncoder;
  }
  
  /**
   * @BeforeScenario
   *
   * @throws \Doctrine\ORM\Tools\ToolsException
   */
  public function clearDatabase()
  {
    $schemaTool = new SchemaTool($this->entityManager);
    $schemaTool->dropSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
    $schemaTool->createSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
  }
  
  /**
   * @Given /^I load fixture file "([^"]*)"$/
   *
   * @param $arg1
   *
   * @throws Exception
   */
  public function iLoadFixtureFile($arg1)
  {
    $loader = new NativeLoader();
    $objectSet = $loader->loadFile(__DIR__.'/../fixtures/'.$arg1);
    foreach($objectSet->getObjects() as $object) {
      if($object instanceof User) {
        $user = new User(
          $object->getUsername(),
          $object->getEmail(),
          $object->getEmailToken(),
          $object->getName(),
          $object->getLastname(),
          $this->passwordEncoder->encodePassword($object, $object->getPassword())
        );
        $this->entityManager->persist($user);
  
      } else {
        $this->entityManager->persist($object);
      }
      $this->entityManager->flush();
    }
  }
  
  /**
   * @Given /^I define resetPasswordToken to user test@gmail\.com\/test$/
   */
  public function iDefineResetPasswordTokenToUserTestGmailComTest()
  {
   $user = $this->entityManager->getRepository(User::class)->getUserByUsernameAndEmail(
     'test',
     'test@gmail.com'
   );
   $user->passwordToken('testToken');
   $this->entityManager->flush();
  }
  
  /**
   * @Given /^I get url trick with slug$/
   */
  public function iGetUrlTrickWithSlug()
  {
    $slug = '1080';
    $this->entityManager->getRepository(Trick::class)->getBySlug($slug);
  }
}
