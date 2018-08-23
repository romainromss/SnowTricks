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

use App\UI\Form\Type\AddTrickType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class AddTricksTypeTest.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickTypeTest extends TypeTestCase
{
    public function testFormWithoutPicture()
    {
      $form = $this->factory->create(AddTrickType::class);
      $form->submit([
        'name' => 'name',
        'description' => 'description',
        'category' => 'category',
      ]);
      static::assertTrue($form->isSynchronized());
      static::assertTrue($form->isValid());
    }
  
  public function testFormWithPicture()
  {
    $file = $this->createMock(File::class);
    
    $form = $this->factory->create(AddTrickType::class);
    $form->submit([
      'name' => 'name',
      'description' => 'description',
      'category' => 'category',
      'pictures' => [
        0 => [
          'file' => $file,
          'legend' => 'legend'
        ],
        1 => [
          'file' => $file,
          'legend' => 'legend'
        ]
      ]
    ]);
    static::assertTrue($form->isSynchronized());
    static::assertTrue($form->isValid());
  }
  
	public function testGoodData()
	{
		$form = $this->factory->create(AddTrickType::class);
		$form->submit([
			'name' => 'name',
			'description' => 'description',
			'category' => 'category',
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
