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

namespace App\Tests\UI\Form\Type;

use App\UI\Form\Type\UpdateTrickType;
use Symfony\Component\Form\Test\TypeTestCase;


/**
 * Class UpdateTrickTypeTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickTypeTest extends TypeTestCase
{
	public function testGoodData()
	{
		$form = $this->factory->create(UpdateTrickType::class);
		$form->submit([
			'name' => 'name',
			'description' => 'description',
			'group' => 'group',
			'slug' => 'slug',
			'pictures' => ['pictures'],
			'movies' => ['movies']
		]);
		static::assertTrue(
			$form->isSubmitted()
		);

		static::assertTrue(
			$form->isValid()
		);
	}
}
