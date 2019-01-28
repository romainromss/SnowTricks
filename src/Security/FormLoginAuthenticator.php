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

namespace App\Security;

use App\Domain\Repository\UserRepository;
use App\UI\Form\Type\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class FormLoginAuthenticator.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class FormLoginAuthenticator extends AbstractGuardAuthenticator
{
  /**@var FormFactoryInterface */
  private $formFactory;
  
  /** @var UserRepository */
  private $userRepository;
  
  /** @var UrlGeneratorInterface */
  private $urlGenerator;
  
  /** @var RouterInterface */
  private $router;
  
  /** @var UserPasswordEncoderInterface */
  private $passwordEncoder;
  
  /**
   * FormLoginAuthenticator constructor.
   *
   * @param FormFactoryInterface         $formFactory
   * @param UserRepository               $userRepository
   * @param UrlGeneratorInterface        $urlGenerator
   * @param UserPasswordEncoderInterface $passwordEncoder
   */
  public function __construct(
    FormFactoryInterface $formFactory,
    UserRepository $userRepository,
    UrlGeneratorInterface $urlGenerator,
    UserPasswordEncoderInterface $passwordEncoder
  ) {
    $this->formFactory = $formFactory;
    $this->userRepository = $userRepository;
    $this->urlGenerator = $urlGenerator;
    $this->passwordEncoder = $passwordEncoder;
  }
  
  /**
   * @param Request $request
   *
   * @return bool
   */
  public function supports(Request $request)
  {
    return $request->attributes->get('_route') === 'login' && $request->isMethod('POST');
  }
  
  
  /**
   * @param Request $request
   *
   * @return mixed Any non-null value
   *
   * @throws \UnexpectedValueException If null is returned
   */
  public function getCredentials(Request $request)
  {
    $form = $this->formFactory->create(LoginType::class)->handleRequest($request);
    return $form->getData();
  }
  
  /**
   * @param mixed                 $credentials
   * @param UserProviderInterface $userProvider
   *
   * @return mixed|UserInterface|null
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getUser(
    $credentials,
    UserProviderInterface $userProvider
  ) {
    
    $user = $this->userRepository->loadUserByUsername($credentials->username);
    if(!$user) {
      throw new CustomUserMessageAuthenticationException('mauvais mot de passe et/ou email');
    }
    return $user;
  }
  
  /**
   * @param mixed         $credentials
   * @param UserInterface $user
   *
   * @return bool
   *
   * @throws AuthenticationException
   */
  public function checkCredentials(
    $credentials,
    UserInterface $user
  ) {
    $encoder = $this->passwordEncoder->isPasswordValid($user, $credentials->password);
    if(!$encoder) {
      throw new CustomUserMessageAuthenticationException('mauvais mot de passe et/ou email');
    }
    return true;
  }
  
  /**
   * @param Request                 $request
   * @param AuthenticationException $exception
   *
   * @return Response|null
   */
  public function onAuthenticationFailure(
    Request $request,
    AuthenticationException $exception
  ) {
    return new RedirectResponse($this->urlGenerator->generate('login'));
  }
  
  /**
   * @param Request        $request
   * @param TokenInterface $token
   * @param string         $providerKey The provider (i.e. firewall) key
   *
   * @return Response|null
   */
  public function onAuthenticationSuccess(
    Request $request,
    TokenInterface $token,
    $providerKey
  ) {
    return new  RedirectResponse($this->urlGenerator->generate('index'));
  }
  
  /**
   * @return bool
   */
  public function supportsRememberMe()
  {
    return false;
  }
  
  /**
   * @param Request                 $request       The request that resulted in an AuthenticationException
   * @param AuthenticationException $authException The exception that started the authentication process
   *
   * @return Response
   */
  public function start(Request $request, AuthenticationException $authException = null)
  {
    $url = $this->router->generate('login');
    return new RedirectResponse($url);
  }
}
