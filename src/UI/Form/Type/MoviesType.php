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

use App\Domain\DTO\Interfaces\MoviesDTOInterface;
use App\Domain\DTO\MoviesDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MoviesType.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class MoviesType extends AbstractType
{
  /**
   * @param FormBuilderInterface $builder
   * @param array                $options
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('embed', TextType::class)
      ->add('legend', TextType::class);
  }
  
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults ([
      'data_class' => MoviesDTOInterface::class,
      'empty_data' => function (FormInterface $form){
        return new MoviesDTO(
          $form->get('embed')->getData(),
          $form->get('legend')->getData()
        );
      },
      'validation_groups' => ['Movie']
    ]);
  }
}