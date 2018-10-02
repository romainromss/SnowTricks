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

namespace App\Domain\DataFixtures;

use App\Domain\Models\Pictures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
  public function load(ObjectManager $manager)
  {
    for($i = 1; $i > 10; $i++) {
      $picture = new Pictures(
        'Name'. $i,
        'Legend'. $i,
        false
      );
      $manager->persist($picture);
    }
    $manager->flush();
  }
}
