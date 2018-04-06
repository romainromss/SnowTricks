<?php
declare(strict_types=1);

namespace Tests\Responder;

use Panthere\PanthereTestCase;

/**
 * Class ResponderHomeFunctionalTest
 *
 * @package Tests\Responder
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderHomeFunctionalTest extends PanthereTestCase
{
    public function testResponder()
    {
        $client = static::createPanthereClient();
        $crawler = $client->request('GET', static::$baseUri.'/');

        $this->assertContains('', $crawler->filter('title')->text());
    }
}
