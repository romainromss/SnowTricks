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

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Response;

class DeletePictureActionFunctionalTest extends WebTestCase
{
  /**
   * @var null | Client
   */
  private $client = null;
  
  protected function setUp()
  {
    $this->client = static::createClient();
  }
  
  public function testGetStatusCode()
  {
    $this->client->request('GET', '/delete/picture/0b433826-276e-44eb-8bae-2347aa71def6');
    static::assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
  }
  
  protected function tearDown()
  {
    $this->client = null;
  }
}
