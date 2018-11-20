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

use App\UI\Form\Type\AddCommentType;
use Symfony\Component\Form\Test\TypeTestCase;

class AddCommentTypeTest extends TypeTestCase
{
    public function testGoodData()
    {
        $form = $this->factory->create(AddCommentType::class);
        $form->submit([
            'content' => 'content'
        ]);
        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}
