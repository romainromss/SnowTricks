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

use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UniqueUserDTOValidator.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UniqueUserDTOValidator extends ConstraintValidator
{
  
  /**
   * @var UserRepository
   */
  private $userRepository;
  
  /**
   * UniqueUserDTOValidator constructor.
   *
   * @param UserRepository $userRepository
   */
  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }
  
  /**
   * @param UniqueUserDTO      $value
   * @param Constraint $constraint
   *
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function validate($value, Constraint $constraint)
  {
    $user = $this->userRepository->getUserByUsernameAndEmail($value->username,$value->mail);
    
    if($user) {
    $this->context->buildViolation($constraint->message)->addViolation();
    }
  }
}
