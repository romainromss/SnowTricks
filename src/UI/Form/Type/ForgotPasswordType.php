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

use App\Domain\DTO\ForgotPasswordDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForgotPasswordType extends AbstractType
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
    $builder->add('username', TextType::class, ['label' => 'Pseudo'])
      ->add('mail', EmailType::class, ['label' => 'E-mail']);
  }
  /**
   * @param OptionsResolver $resolver
   *
   * @return mixed|void
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => ForgotPasswordDTO::class,
      'empty_data' => function (FormInterface $form) {
        return new ForgotPasswordDTO(
          $form->get('username')->getData(),
          $form->get('mail')->getData()
        );
      },
      'validation_groups' => ['']
    ]);
  }
}
