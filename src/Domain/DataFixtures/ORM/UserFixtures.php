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

use App\Domain\Models\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
  /**
   * @param ObjectManager $manager
   *
   * @throws \Exception
   */
  public function load(ObjectManager $manager)
  {
    for($i = 1; $i > 10; $i++) {
      $users = new Users(
        'username'. $i,
        'email@gmail.com',
        'name'. $i,
        'lastname'. $i,
        '12345678'.$i,
        'user'
      );
      $manager->persist($users);
    }
    $manager->flush();
  }
}
