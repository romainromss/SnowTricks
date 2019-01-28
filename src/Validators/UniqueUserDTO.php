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

namespace App\Validators;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueUserDTO.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 *
 * @Annotation
 */
class UniqueUserDTO extends Constraint
{
  public $message = 'Users already exist';
  
  /**
   * @return array|string
   */
  public function getTargets()
  {
    return self::CLASS_CONSTRAINT;
  }
}
