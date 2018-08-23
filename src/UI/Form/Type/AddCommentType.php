<?php

declare(strict_types=1);

/*
 * This file is part of the SnowTricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Type;

use App\Domain\DTO\AddCommentDTO;
use App\Domain\DTO\Interfaces\AddCommentDTOInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddCommentType.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
	{
        $builder
            ->add('content', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddCommentDTOInterface::class,
            'empty_data' => function (FormInterface $form){
                return new AddCommentDTO(
                    $form->get('content')->getData()
                );
            }
        ]);
    }
}
