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
    
    use App\Domain\DTO\Interfaces\PictureDTOInterface;
    use App\Domain\DTO\PictureDTO;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\FormInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class PictureType extends AbstractType
    {
        public function buildForm (FormBuilderInterface $builder, array $options)
        {
          $builder
            ->add('file', FileType::class)
            ->add ('legend', TextType::class);
        }
        
        public function configureOptions (OptionsResolver $resolver)
        {
          $resolver->setDefaults ([
            'data_class' => PictureDTOInterface::class,
            'empty_data' => function (FormInterface $form){
              return new PictureDTO(
                $form->get('file')->getData(),
                $form->get('legend')->getData()
              );
            },
            'validation_groups' => ['Picture']
          ]);
        }
    }
    