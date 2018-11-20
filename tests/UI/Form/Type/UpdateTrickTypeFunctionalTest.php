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
 * Class PictureTypeFunctionalTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickTypeFunctionalTest extends WebTestCase
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
    $this->client->request('GET', '/update/trick/melancholie');
    static::assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
  }
  
  public function testUpdateTrickForm()
  {
    $crawler = $this->client->request('GET', '/tricks/melancholie');
    $link = $crawler->selectLink('Modifier')->link();
    $crawler = $this->client->click($link);
    $form = $crawler->selectButton('update_trick')->form();
    $fields = $form->getPhpValues();
  
    $form['update_trick[name]'] = 'Name';
    $form['update_trick[description]'] = 'Description';
    $form['update_trick[category]'] = 'Category';
    $fields['update_trick']['pictures'][0]['file'] = new UploadedFile(__DIR__.'/../../../assets/360.svg', '360.svg', 'image/svg+xml');
    $fields['update_trick']['movies'][0]['embed'] = 'rwop22485';
    $this->client->submit($form);
    static::assertEquals(0, $crawler->filter('div.flash-notice')->count());
  }
  
  protected function tearDown()
  {
    $this->client = null;
  }
}
