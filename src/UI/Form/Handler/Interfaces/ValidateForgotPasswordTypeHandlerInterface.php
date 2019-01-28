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

namespace App\UI\Form\Handler\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Interface ValidateForgotPasswordTypeHandlerInterface
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface ValidateForgotPasswordTypeHandlerInterface
{
  /**
   * @param FormInterface  $form
   * @param UsersInterface $user
   *
   * @return bool
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function handle(FormInterface $form, UsersInterface $user);
}
