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

namespace App\UI\Form\Handler;

use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;

/**
 * Class ValidateForgotPasswordTypeHandler.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ValidateForgotPasswordTypeHandler
{
  /**
   * @var UserRepositoryInterface
   */
  private $userRepository;
  /**
   * @var Environment
   */
  private $twig;
  
  /**
   * @var EncoderFactoryInterface
   */
  private $encoderFactory;
  
  /**
   * ValidateForgotPasswordTypeHandler constructor.
   *
   * @param UserRepositoryInterface $userRepository
   * @param Environment             $twig
   * @param EncoderFactoryInterface $encoderFactory
   */
  public function __construct(
    UserRepositoryInterface $userRepository,
    Environment $twig,
    EncoderFactoryInterface $encoderFactory
  ) {
    $this->userRepository = $userRepository;
    $this->twig = $twig;
    $this->encoderFactory = $encoderFactory;
  }
  
  /**
   * @param FormInterface $form
   * @param Request       $request
   *
   * @return bool
   * @throws \Doctrine\ORM\NonUniqueResultException
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function handle(FormInterface $form, Request $request)
  {
    if ($form->isSubmitted() && $form->isValid()) {
      $encoder = $this->encoderFactory->getEncoder(User::class);
      $encoder->encodePassword($form->getData()->password, '');
      $this->userRepository->flush();
      return true;
    }
    return false;
  }
}