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

namespace App\UI\Actions;

use App\Domain\DTO\RegisterUserDTO;
use App\UI\Form\Handler\RegisterUserHandler;
use App\UI\Form\Type\RegisterUserType;
use App\UI\Responder\ResponderRegisterUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegisterUserAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class RegisterUserAction
{
  /**
   * @var FormFactoryInterface
   */
  private $formFactory;
  
  /**
   * @var RegisterUserHandler
   */
  private $registerUserHandler;
  
  public function __construct(
    FormFactoryInterface $formFactory,
    RegisterUserHandler $registerUserHandler
  ) {
    $this->formFactory = $formFactory;
    $this->registerUserHandler = $registerUserHandler;
  
  }
  
  /**
   * @Route("register", name="Register")
   *
   * @param Request               $request
   *
   * @param ResponderRegisterUser $responderRegisterUser
   *
   * @return mixed
   * @throws \Twig_Error_Loader
   * @throws \Twig_Error_Runtime
   * @throws \Twig_Error_Syntax
   */
  public function __invoke(
    Request $request,
    ResponderRegisterUser $responderRegisterUser
  ) {
    $registerUserType = $this->formFactory
      ->create(RegisterUserType::class)
      ->handleRequest($request);
  
    return $responderRegisterUser(['form' => $registerUserType->createView()]);
  }
}