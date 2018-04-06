<?php
declare(strict_types=1);

namespace App\Domain\Models\Interfaces;

/**
 * Interface TricksInterface
 *
 * @package App\Domain\Models\Interfaces
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
interface TricksInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getPictures(): \ArrayAccess;

    /**
     * @return \ArrayAccess
     */
    public function getComments(): \ArrayAccess;

    /**
     * @return mixed
     */
    public function getUser();

    /**
     * @return mixed
     */
    public function getId(): string;

    /**
     * @return mixed
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getGroup(): string;

    /**
     * @return int
     */
    public function getUpdatedAt(): ? int;

    /**
     * @return int
     */
    public function getCreatedAt(): int;

    /**
     * @return \ArrayAccess
     */
    public function getMovies(): \ArrayAccess;

    /**
     * @return string
     */
    public function getSlug(): string;

    /**
     * @param array $pictures
     *
     * @return array
     */
    public function addPictures(PicturesInterface $pictures);


    /**
     * @param PicturesInterface $pictures
     */
    public function unsetPictures(PicturesInterface $pictures): void;

    /**
     * @param $movies
     *
     * @return mixed
     */
    public function addMovies(MoviesInterface $movies);



    /**
     * @param $movies
     */
    public function unsetMovies(MoviesInterface $movies): void;

    /**
     * @param $comments
     *
     * @return mixed
     */
    public function addComments(CommentsInterface $comments): void;


    /**
     * @param $comments
     */
    public function unsetComment(CommentsInterface $comments): void;
}
