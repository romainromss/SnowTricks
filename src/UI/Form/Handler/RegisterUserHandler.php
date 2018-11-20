<?php

declare(strict_types = 1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Handler;

use App\Domain\Models\User;
use Symfony\Component\Form\FormInterface;

class RegisterUserHandler
{
  public function __construct()
  {
  }
  
  public function handle(
    FormInterface $form
  ) {
    
    if ($form->isSubmitted() && $form->isValid()) {
     $name = $form->getData()->name;
     $username = $form->getData()->username;
     $lastname = $form->getData()->lastname;
     $mail = $form->getData()->mail;
     $password = $form->getData()->password;
     
     $user = new User(
       $name,
       $username,
       $lastname,
       $mail,
       password_
       );
    }
  }
  
}
