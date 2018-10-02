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

namespace App\Domain\DataFixtures\ORM;

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
    $movie1 = new Movies(
      'embed'. 1,
      'legend'. 1
    );
    $this->addReference('movies1', $movie1);
  
    $movie2 = new Movies(
      'embed'. 1,
      'legend'. 1
    );
    $this->addReference('movies2', $movie2);
    
    $movie3 = new Movies(
      'embed'. 1,
      'legend'. 1
    );
    $this->addReference('movies3', $movie3);
    
    $movie4 = new Movies(
      'embed'. 1,
      'legend'. 1
    );
    $this->addReference('movies4', $movie4);
    
    $movie5 = new Movies(
      'embed'. 1,
      'legend'. 1
    );
    $this->addReference('movies5', $movie5);
    
    $movie6 = new Movies(
      'embed'. 1,
      'legend'. 1
    );
    $this->addReference('movies6', $movie6);
    
    $movie7 = new Movies(
      'embed'. 1,
      'legend'. 1
    );
    $this->addReference('movies7', $movie7);
    
    $movie8 = new Movies(
      'embed'. 1,
      'legend'. 1
    );
    $this->addReference('movies8', $movie8);
    
    $manager->persist($movie1);
    $manager->persist($movie2);
    $manager->persist($movie3);
    $manager->persist($movie4);
    $manager->persist($movie5);
    $manager->persist($movie6);
    $manager->persist($movie7);
    $manager->persist($movie8);
    
    $manager->flush();
  }
}
