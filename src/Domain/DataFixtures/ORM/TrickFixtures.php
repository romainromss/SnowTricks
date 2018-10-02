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

use App\Domain\Models\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
  /**
   * @param ObjectManager $manager
   */
  public function load(ObjectManager $manager)
  {
    for($i = 1; $i > 10; $i++) {
      $trick = new Tricks(
        'Trick'.$i,
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.$i,
        'Groupe'.$i,
        $this->getReference('user'),
        $this->getReference('pictures')
      );
      $manager->persist($trick);
    }
    $manager->flush();
  }
  
  public function getDependencies()
  {
    return [
      PictureFixtures::class,
      MovieFixtures::class,
      UserFixtures::class
    ];
  }
}
