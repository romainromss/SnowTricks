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

use App\Domain\DTO\LoginUserDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LoginType.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class LoginType extends AbstractType implements FormTypeInterface
{
  /**
   * @param FormBuilderInterface $builder
   * @param array                $options
   *
   * @return mixed|void
   */
  public function buildForm(
    FormBuilderInterface $builder,
    array $options
  ) {
    $builder
      ->add('username', TextType::class, ['label' => 'pseudo'])
      ->add('password', PasswordType::class, ['label' => 'Mot de passe']);
  }
  /**
   * @param OptionsResolver $resolver
   *
   * @return mixed|void
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => LoginUserDTO::class,
      'empty_data' => function (FormInterface $form) {
        return new LoginUserDTO(
          $form->get('username')->getData(),
          $form->get('password')->getData()
        );
      },
      'validation_groups' => ['connection']
    ]);
  }
}
