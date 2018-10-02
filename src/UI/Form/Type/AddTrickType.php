<?php

declare(strict_types=1);

/*
 * This file is part of the Snowtricks project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Type;

use App\Domain\DTO\AddTrickDTO;
use App\Domain\DTO\Interfaces\AddTrickDTOInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddTrickType.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddTrickType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', TextType::class)
			->add('description', TextareaType::class)
			->add('category', TextType::class)
			->add('pictures', CollectionType::class, [
				'entry_type' => PictureType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'label' => 'Au moins une image est obligatoire',
				'required' => true,
				'entry_options' => [
					'label' => false
				],
			])
			->add('movies', CollectionType::class, [
				'entry_type' => MoviesType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'label' => 'Au moins une vidéo est obligatoire',
				'required' => true,
				'entry_options' => [
					'label' => false
				],
			])
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => AddTrickDTOInterface::class,
			'empty_data' => function (FormInterface $form){
				return new AddTrickDTO(
					$form->get('name')->getData(),
					$form->get('description')->getData(),
					$form->get('category')->getData(),
					$form->get('pictures')->getData(),
					$form->get('movies')->getData()
				);
			},
          'validation_groups' => ['AddTrick'],
		]);
	}
}
