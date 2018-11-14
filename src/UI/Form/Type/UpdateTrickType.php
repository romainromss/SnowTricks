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
use App\UI\Form\DataTransformer\MoviesToFileTransformer;
use App\UI\Form\DataTransformer\PicturesToFIleTransformer;
use App\UI\Subscriber\MovieUpdateSubscriber;
use App\UI\Subscriber\PictureUpdateSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
  /**
   * @var MovieUpdateSubscriber
   */
  private $MovieUpdateSubscriber;
  
  
  /**
   * @var PictureUpdateSubscriber
   */
  private $pictureUpdateSubscriber;
  /**
   * @var PicturesToFileTransformer
   */
  private $picturesToFileTransformer;
  /**
   * @var MoviesToFileTransformer
   */
  private $moviesToFileTransformer;
  
  /**
   * UpdateTrickType constructor.
   *
   * @param MovieUpdateSubscriber     $MovieUpdateSubscriber
   * @param PictureUpdateSubscriber   $pictureUpdateSubscriber
   * @param PicturesToFIleTransformer $picturesToFileTransformer
   * @param MoviesToFileTransformer   $moviesToFileTransformer
   */
  public function __construct(
    MovieUpdateSubscriber $MovieUpdateSubscriber,
    PictureUpdateSubscriber $pictureUpdateSubscriber,
    PicturesToFileTransformer $picturesToFileTransformer,
    MoviesToFileTransformer $moviesToFileTransformer
  )
  {
    $this->MovieUpdateSubscriber = $MovieUpdateSubscriber;
    $this->pictureUpdateSubscriber = $pictureUpdateSubscriber;
    $this->picturesToFileTransformer = $picturesToFileTransformer;
    $this->moviesToFileTransformer = $moviesToFileTransformer;
  }
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
    
    $builder->get('pictures')->addModelTransformer($this->picturesToFileTransformer);
    $builder->get('movies')->addModelTransformer($this->moviesToFileTransformer);
  }
  
  /**
   * @inheritdoc
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => UpdateTrickDTO::class
    ]);
  }
}
