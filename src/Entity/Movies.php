<?php

namespace App\Entity;

class Movies
{
    private $id;
    private $embed;
    private $legend;
    private $trick;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @param mixed $embed
     */
    public function setEmbed($embed): void
    {
        $this->embed = $embed;
    }

    /**
     * @return mixed
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @param mixed $legend
     */
    public function setLegend($legend): void
    {
        $this->legend = $legend;
    }

    /**
     * @return mixed
     */
    public function getTricks()
    {
        return $this->trick;
    }

    /**
     * @param mixed $tricks
     */
    public function setTricks($tricks): void
    {
        $this->trick = $tricks;
    }
}
