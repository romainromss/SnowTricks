<?php

declare(strict_types=1);

/*
 * This file is part of the ${project} project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Domain\DTO;

/**
 * Class AddCommentDTO.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class AddCommentDTO
{
    /**
     * @var string
     */
    public $content;

    /**
     * AddCommentDTO constructor.
     *
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }
}
