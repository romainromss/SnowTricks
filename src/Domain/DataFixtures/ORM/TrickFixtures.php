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

use App\Domain\Models\Trick;
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
    $trick1 = new Trick(
      '1080',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.'a',
      'group'.'a',
      $this->getReference('users'),
      [$this->getReference('pictures1'), $this->getReference('pictures11')],
      [$this->getReference('movies1')]
    );
    $this->addReference('tricks1', $trick1);
    
    $trick2 = new Trick(
      '360',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.'a',
      'group'.'a',
      $this->getReference('users'),
      [$this->getReference('pictures2')],
      [$this->getReference('movies2')]
    );
    $this->addReference('tricks2', $trick2);
    
    $trick3 = new Trick(
      '540',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.'a',
      'group'.'a',
      $this->getReference('users'),
      [$this->getReference('pictures3')],
      [$this->getReference('movies3')]
    );
    $this->addReference('tricks3', $trick3);
    
    $trick4 = new Trick(
      'backflip',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.'a',
      'group'.'a',
      $this->getReference('users'),
      [$this->getReference('pictures4')],
      [$this->getReference('movies4')]
    );
    $this->addReference('tricks4', $trick4);
    
    $trick5 = new Trick(
      'frontflip',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.'a',
      'group'.'a',
      $this->getReference('users'),
      [$this->getReference('pictures5')],
      [$this->getReference('movies5')]
    );
    $this->addReference('tricks5', $trick5);
    
    $trick6 = new Trick(
      'indy',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.'a',
      'group'.'a',
      $this->getReference('users'),
      [$this->getReference('pictures6')],
      [$this->getReference('movies6')]
    );
    $this->addReference('tricks6', $trick6);
    
    $trick7 = new Trick(
      'melancholie',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.'a',
      'group'.'a',
      $this->getReference('users'),
      [$this->getReference('pictures7')],
      [$this->getReference('movies7')]
    );
    $this->addReference('tricks7', $trick7);
    
    $trick8 = new Trick(
      'methodair',
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum cursus purus id vulputate pulvinar. Sed.'.'a',
      'group'.'a',
      $this->getReference('users'),
      [$this->getReference('pictures8')],
      [$this->getReference('movies8')]
    );
    $this->addReference('tricks8', $trick8);
    
    $manager->persist($trick1);
    $manager->persist($trick2);
    $manager->persist($trick3);
    $manager->persist($trick4);
    $manager->persist($trick5);
    $manager->persist($trick6);
    $manager->persist($trick7);
    $manager->persist($trick8);
    
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
