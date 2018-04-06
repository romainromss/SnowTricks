<?php
declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\MoviesInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class Movies
 *
 * @package App\Domain\Models
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class Movies implements MoviesInterface
{
    private $id;
    private $embed;
    private $legend;
    private $trick;

    public function __construct(
        string $embed,
        string $legend,
        Tricks $tricks = null
    ) {
        $this->id = Uuid::uuid4();
        $this->embed = $embed;
        $this->legend = $legend;
        $this->trick = $tricks;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @return mixed
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * @return mixed
     */
    public function getTricks()
    {
        return $this->trick;
    }
}
