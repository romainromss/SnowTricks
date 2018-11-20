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

namespace App\UI\Form\Type;

use App\Domain\DTO\RegisterUserDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RegisterUserType.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class RegisterUserType extends AbstractType
{
  /**
   * @param FormBuilderInterface $builder
   * @param array                $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('mail', ['label' => 'E-mail'])
      ->add('username', TextType::class, ['label' => 'Pseudo', 'csrf_field_name' => "username"])
      ->add('name', TextType::class, ['label' => 'Prenom'])
      ->add('lastname', TextType::class, ['label' => 'Nom'])
      ->add('password', RepeatedType::class, [
        'type' => PasswordType::class,
        'invalid_message' => 'The password fields must match.',
        'options' => ['attr' => ['class' => 'password-field']],
        'required' => true,
        'first_options'  => ['label' => 'Mot de passe'],
        'second_options' => ['label' => 'Confirmer le mot de passe']
      ]);
  }
  
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => RegisterUserDTO::class,
      'empty_data' => function (FormInterface $form) {
        return new RegisterUserDTO(
          $form->get('mail')->getData(),
          $form->get('username')->getData(),
          $form->get('name')->getData(),
          $form->get('lastname')->getData(),
          $form->get('password')->getData()
        );
      },
      'validation_groups' => ['RegisterUser'],
    ]);
  }
}