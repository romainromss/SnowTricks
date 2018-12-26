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

use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * Class DoctrineContext.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class DoctrineContext implements Context
{
  /** @var EntityManagerInterface */
  private $entityManager;
  
  /**
   * DoctrineContext constructor.
   *
   * @param EntityManagerInterface $entityManager
   */
  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
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
}