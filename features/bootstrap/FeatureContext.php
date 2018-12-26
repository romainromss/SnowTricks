<?php

use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
class FeatureContext extends MinkContext
{
  /**
   * @var KernelInterface
   */
  private $kernel;
  
  /** @var EntityManagerInterface */
  private $entityManager;
  
  public function __construct(
    KernelInterface $kernel,
    EntityManagerInterface $entityManager
  ) {
    $this->kernel = $kernel;
    $this->entityManager = $entityManager;
  }
  
  /**
   * @param string $username
   *
   * @throws ExpectationException
   * @throws \Doctrine\ORM\NonUniqueResultException
   *
   * @Then User :username should be exist into database
   */
  public function userShouldBeExistIntoDatabase($username)
  {
    $user = $this->entityManager->getRepository(\App\Domain\Models\User::class)->getUserByUsername($username);
    if(!$user) {
      throw new ExpectationException(
        'User with username should be exist',
        $this->getSession()->getDriver()
      );
    }
  }
}
