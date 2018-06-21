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

use App\Domain\DTO\UpdateTrickDTO;
use App\Domain\Models\Pictures;
use App\UI\Form\DataTransformer\Interfaces\PicturesToFileTransformerInterface;
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
	 * @return mixed
	 */
	public function transform($value)
	{
		if (!$value instanceof UpdateTrickDTO) {
			return;
		}

		foreach ($value->pictures as $picture) {
			$value->pictures[] = new File($this->imageFolder.$picture->getName());

			unset($value->pictures[array_search($picture, $value->pictures)]);
		}
		return $value;
	}


	public function reverseTransform($value)
	{
	  foreach ($value->pictures as $file){
	    $value->pictures[] = new  Pictures($file->name, $file->legend, $file->first);

	    unset($value->pictures[array_search($file, $value->pictures)]);
    }
    return $value;
	}
}
