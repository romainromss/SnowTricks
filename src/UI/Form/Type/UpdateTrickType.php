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

use App\Domain\DTO\Interfaces\UpdateTrickDTOInterface;
use App\Domain\DTO\UpdateTrickDTO;
use App\UI\Form\DataTransformer\PicturesToFIleTransformer;
use App\UI\Form\DataTransformer\PicturesToFileTransformerInterface;
use App\UI\Subscriber\UpdateTrickSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UpdateTrickType.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class UpdateTrickType extends AbstractType
{

	/**
	 * @var UpdateTrickSubscriber
	 */
	private $updateTrickSubscriber;
	/**
	 * @var PicturesToFileTransformerInterface
	 */
	private $picturesToFileTransformer;

	public function __construct(
		UpdateTrickSubscriber $updateTrickSubscriber,
		PicturesToFileTransformer $picturesToFileTransformer
	)
	{
		$this->updateTrickSubscriber = $updateTrickSubscriber;
		$this->picturesToFileTransformer = $picturesToFileTransformer;
	}

	/**
	 * @param FormBuilderInterface  $builder
	 * @param array                 $options
	 */
	public function buildForm(
		FormBuilderInterface $builder,
		array $options
	) {
		$builder
			->add('name', TextType::class, [
				'label' => 'Titre'
			])
			->add('description', TextareaType::class)
			->add('group', TextType::class, [
				'label' => 'Groupe'
			])
			->add('pictures', CollectionType::class, [
				'entry_type' => FileType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'label' => false,
				'entry_options' => [
					'label' => false
				],
			])
			->add('movies', CollectionType::class, [
				'entry_type' => TextType::class,
				'allow_add' => true,
				'allow_delete' => true,
				'label' => false,
				'required' => false,
				'entry_options' => [
					'label' => false
				],
			])
			->addEventSubscriber($this->updateTrickSubscriber)
		;
		$builder->get('pictures')
			->addModelTransformer($this->picturesToFileTransformer);
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => UpdateTrickDTOInterface::class,
			'empty_data' => function (FormInterface $form){
				return new UpdateTrickDTO(
					$form->get('name')->getData(),
					$form->get('description')->getData(),
					$form->get('group')->getData(),
					$form->get('slug')->getData(),
					$form->get('pictures')->getData(),
					$form->get('movies')->getData()
				);
			}
		]);
	}
}
