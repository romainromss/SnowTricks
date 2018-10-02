<?php

declare(strict_types = 1);

/*
 * This file is part of snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\DataFixtures;

use App\Domain\Models\Movies;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
  /**
   * @param ObjectManager $manager
   *
   * @throws \Exception
   */
  public function load(ObjectManager $manager)
  {
    for($i = 1; $i > 10; $i++) {
      $movie = new Movies(
        'embed'. $i,
        'legend'. $i
      );
      $manager->persist($movie);
    }
    $manager->flush();
  }
}
