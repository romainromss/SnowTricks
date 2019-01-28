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

namespace App\Domain\DataFixtures\ORM;

use App\Domain\Models\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
  /**
   * @param ObjectManager $manager
   *
   * @throws \Exception
   */
  public function load(ObjectManager $manager)
  {
    $picture1 = new Picture(
      '1080.svg',
      'Legend'. 1,
      true
    );
    $this->addReference('pictures1', $picture1);
  
    $picture11 = new Picture(
      'mute.svg',
      'Legend'. 1,
      false
    );
    $this->addReference('pictures11', $picture11);
    
    $picture2 = new Picture(
      '360.svg',
      'Legend'. 1,
      true
    );
    $this->addReference('pictures2', $picture2);
    
    $picture3 = new Picture(
      '540.svg',
      'Legend'. 1,
      true
    );
    $this->addReference('pictures3', $picture3);
  
    $picture4 = new Picture(
      'backflip.svg',
      'Legend'. 1,
      true
    );
    $this->addReference('pictures4', $picture4);
    
    $picture5 = new Picture(
      'frontflip.svg',
      'Legend'. 1,
      true
    );
    $this->addReference('pictures5', $picture5);
  
    $picture6 = new Picture(
      'indy.svg',
      'Legend'. 1,
      true
    );
    $this->addReference('pictures6', $picture6);
  
    $picture7 = new Picture(
      'melancholie.svg',
      'Legend'. 1,
      true
    );
    $this->addReference('pictures7', $picture7);
  
    $picture8 = new Picture(
      'methodair.svg',
      'Legend'. 1,
      true
    );
    $this->addReference('pictures8', $picture8);
    
    $manager->persist($picture1);
    $manager->persist($picture2);
    $manager->persist($picture3);
    $manager->persist($picture4);
    $manager->persist($picture5);
    $manager->persist($picture6);
    $manager->persist($picture7);
    $manager->persist($picture8);
    $manager->flush();
  }
}