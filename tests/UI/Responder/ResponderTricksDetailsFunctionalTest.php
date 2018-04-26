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

namespace App\Tests\UI\Responder;

use Panthere\PanthereTestCase;

/**
 * Class ResponderHomeFunctionalTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ResponderTricksDetailsFunctionalTest extends PanthereTestCase
{
    public function testResponder()
    {
        $client = static::createPanthereClient();
        $crawler = $client->request('GET', static::$baseUri.'/tricks/test');

        $this->assertContains('', $crawler->filter('title')->text());
    }
}
