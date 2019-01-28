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

namespace App\UI\Actions;

use App\UI\Form\Type\LoginType;
use App\UI\Responder\LoginResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginAction.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class LoginAction
{
  
  /** @var FormFactoryInterface */
  private $formFactory;
  
  /**
   * LoginAction constructor.
   *
   * @param FormFactoryInterface $formFactory
   */
  public function __construct(FormFactoryInterface $formFactory)
  {
    $this->formFactory = $formFactory;
  }
  
  /**
   * @Route("/login", name="login")
   *
   * @param Request             $request
   * @param AuthenticationUtils $authenticationUtils
   * @param LoginResponder      $loginResponder
   *
   * @return mixed
   */
  public function __invoke(
    Request $request,
    AuthenticationUtils $authenticationUtils,
    LoginResponder $loginResponder
  ) {
    $form = $this->formFactory->create(LoginType::class);
    return $loginResponder(
      [
        'form' => $form->createView(),
      ]
    );
  }
}
