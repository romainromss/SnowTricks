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

namespace App\UI\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class PicturesToFIleTransformer.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class PicturesToFIleTransformer implements DataTransformerInterface, PicturesToFileTransformerInterface
{
	/**
	 * @var string
	 */
	private $imageFolder;

	/**
	 * PicturesToFIleTransformer constructor.
	 *
	 * @param string $imageFolder
	 */
	public function __construct(string $imageFolder)
	{
		$this->imageFolder = $imageFolder;
	}

	/**
	 * @param mixed $value
	 *
	 * @return mixed|void
	 */
	public function transform($value)
	{
		if (!\is_array($value)) {
			return;
		}

		foreach ($value as $picture) {
			$value[] = new File($this->imageFolder.$picture->getName());

			unset($value[array_search($picture, $value)]);
		}
	}

	public function reverseTransform($value)
	{
		if (!$value) {
			return;
		}

		foreach ($value as $picture) {
			if ($value->getPictures() == $value){
			$value[] = [$picture];
			}

		}
	}
}
