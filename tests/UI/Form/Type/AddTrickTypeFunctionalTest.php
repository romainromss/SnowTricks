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

namespace App\Tests\UI\Form\Type;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AddTrickTypeFunctionalTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickTypeFunctionalTest extends WebTestCase
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
    $this->client->request('GET', '/addtrick');
    static::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
  }
  
  public function testAddTrickForm()
  {
    $crawler = $this->client->request('GET', '/addtrick');
    $form = $crawler->selectButton('add_trick')->form();
    $form['add_trick[name]'] = 'Name';
    $form['add_trick[description]'] = 'Description';
    $form['add_trick[category]'] = 'Category';
    $fields['update_trick']['pictures'][0]['file'] = new UploadedFile(__DIR__.'/../../../assets/360.svg', '360.svg', 'image/svg+xml');
    $fields['update_trick']['movies'][0]['embed'] = 'rwop22485';
    $this->client->submit($form);
    static::assertEquals(1, $crawler->filter('div.flash-notice')->count());
  }
  
  protected function tearDown()
  {
    $this->client = null;
  }
}