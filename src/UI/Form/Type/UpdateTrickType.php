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

use App\Domain\DTO\UpdateTrickDTO;
use App\UI\Subscriber\MovieUpdateSubscriber;
use App\UI\Subscriber\PictureUpdateSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateTrickType extends AbstractType
{
  /** @var PictureUpdateSubscriber  */
  private $pictureUpdateSubscriber;
  
  /** @var MovieUpdateSubscriber  */
  private $movieUpdateSubscriber;
  
  /**
   * UpdateTrickType constructor.
   *
   * @param PictureUpdateSubscriber $pictureUpdateSubscriber
   * @param MovieUpdateSubscriber   $movieUpdateSubscriber
   */
  public function __construct(
    PictureUpdateSubscriber $pictureUpdateSubscriber,
    MovieUpdateSubscriber $movieUpdateSubscriber
  ) {
    $this->pictureUpdateSubscriber = $pictureUpdateSubscriber;
    $this->movieUpdateSubscriber = $movieUpdateSubscriber;
  }
  
  /** {@inheritdoc} */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', TextType::class)
      ->add('description', TextType::class)
      ->add('category', TextType::class)
      ->add('pictures', CollectionType::class, [
        'entry_type' => PictureType::class,
        'allow_add' => true,
        'allow_delete' => true,
        'label' => false,
        'required' => false,
        'entry_options' => [
          'label' => false
        ],
      ])
      ->add('movies', CollectionType::class, [
        'entry_type' => MoviesType::class,
        'allow_add' => true,
        'allow_delete' => true,
        'label' => false,
        'required' => true,
        'entry_options' => [
          'label' => false
        ],
      ])
    ;
    
    $builder->get('pictures')->addEventSubscriber($this->pictureUpdateSubscriber);
    $builder->get('movies')->addEventSubscriber($this->movieUpdateSubscriber);
  }
  
  /**
   * @inheritdoc
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => UpdateTrickDTO::class,
      'empty_data' => function (FormInterface $form){
        return new UpdateTrickDTO(
          $form->get('name')->getData(),
          $form->get('description')->getData(),
          $form->get('category')->getData(),
          $form->get('pictures')->getData(),
          $form->get('movies')->getData()
        );
      },
      'validation_groups' => ['']
    ]);
  }
}
