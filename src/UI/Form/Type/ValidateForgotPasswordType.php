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

namespace App\UI\Form\Type;

use App\Domain\DTO\ValidateForgotPasswordDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ValidateForgotPasswordType.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class ValidateForgotPasswordType extends AbstractType implements FormTypeInterface
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('password', RepeatedType::class, [
        'type' => PasswordType::class,
        'required' => true,
        'first_options'  => ['label' => 'Mot de passe'],
        'second_options' => ['label' => 'Confirmer le mot de passe']
      ]);
  }
  
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => ValidateForgotPasswordDTO::class,
      'empty_data' => function (FormInterface $form) {
        return new ValidateForgotPasswordDTO(
          $form->get('password')->getData()
        );
      },
      'validation_groups' => ['']
    ]);
  }
}