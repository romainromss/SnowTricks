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

use App\Domain\Factory\UserFactory;
use App\Domain\Models\Picture;
use App\Domain\Models\User;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Domain\Repository\UserRepository;
use App\Infra\Services\GeneratorTokenService;
use App\Infra\Events\UserEvent;
use App\Infra\Helper\UploaderHelper;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class RegisterUserHandler
{
  /** @var EncoderFactoryInterface */
  private $encoderFactory;
  
  /** @var UserFactory */
  private $userFactory;
  
  /** @var UserRepositoryInterface */
  private $userRepository;
  
  /** @var string */
  private $imageFolder;
  
  /** @var UploaderHelper */
  private $uploaderHelper;
  
  /** @var EventDispatcherInterface */
  private $eventDispatcher;
  
  /**
   * RegisterUserHandler constructor.
   *
   * @param EncoderFactoryInterface        $encoderFactory
   * @param UserFactory                    $userFactory
   * @param UserRepository                 $userRepository
   * @param string                         $imageFolder
   * @param UploaderHelper                 $uploaderHelper
   * @param EventDispatcherInterface       $eventDispatcher
   */
  public function __construct(
    EncoderFactoryInterface $encoderFactory,
    UserFactory $userFactory,
    UserRepository $userRepository,
    string $imageFolder,
    UploaderHelper $uploaderHelper,
    EventDispatcherInterface $eventDispatcher
  ) {
    $this->encoderFactory = $encoderFactory;
    $this->userFactory = $userFactory;
    $this->userRepository = $userRepository;
    $this->imageFolder = $imageFolder;
    $this->uploaderHelper = $uploaderHelper;
    $this->eventDispatcher = $eventDispatcher;
  }
  
  /**
   * @param FormInterface $form
   *
   * @return bool
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function handle(
    FormInterface $form
  ) {
    
    if ($form->isSubmitted() && $form->isValid()) {
      $encoder = $this->encoderFactory->getEncoder(User::class);
      $picture = $form->getData()->picture;
      $fileName = $this->uploaderHelper->upload($picture->file);
      
      $user = $this->userFactory->create(
        $form->getData()->username,
        $form->getData()->mail,
        $email_token = GeneratorTokenService::generateToken(),
        $form->getData()->name,
        $form->getData()->lastname,
        $encoder->encodePassword($form->getData()->password, ''),
        $picture = new Picture($fileName, $form->getData()->picture->legend, $form->getData()->picture->first)
      );
      $this->eventDispatcher->dispatch(UserEvent::USER_REGISTER, new UserEvent($user));
      $this->userRepository->save($user);
      return true;
    }
    return false;
  }
}
