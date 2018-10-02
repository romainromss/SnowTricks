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

use App\Domain\Models\Comments;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
  /**
   * @param ObjectManager $manager
   *
   * @throws \Exception
   */
  public function load(ObjectManager $manager)
  {
    for($i = 1; $i > 10; $i++) {
      $comment = new Comments(
        'content'. $i,
        $this->getReference('tricks')
      );
      $manager->persist($comment);
    }
    $manager->flush();
  }
  
  public function getDependencies()
  {
    return [
      TrickFixtures::class
    ];
  }
}
