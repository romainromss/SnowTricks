<?php

declare(strict_types=1);

/*
 * This file is part of the ${project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Handler\Intefaces;

use App\Domain\Models\Interfaces\TricksInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Interface AddCommentTypeHandlerInterface.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface AddCommentTypeHandlerInterface
{
    public function handle(
        FormInterface $form,
        TricksInterface $tricks
    ):  bool;
}