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

  namespace App\Domain\Models;

  use App\Domain\Models\Interfaces\PicturesInterface;
  use App\Domain\Models\Interfaces\TricksInterface;
  use Ramsey\Uuid\Uuid;
  use Ramsey\Uuid\UuidInterface;

  /**
   * Class Pictures.
   *
   * @author Romain Bayette <romain.romss@gmail.com>
   */
  class Pictures implements PicturesInterface
  {

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $legend;

    /**
     * @var bool
     */
    private $first;
  
    /**
     * Pictures constructor.
     *
     * @param string $name
     * @param string $legend
     * @param bool   $first
     *
     * @throws \Exception
     */
    public function __construct(
     string $name,
     string $legend,
     bool $first
    ) {
      $this->id = Uuid::uuid4();
      $this->name = $name;
      $this->legend = $legend;
      $this->first = $first;
    }

    /**
     * @return UuidInterface
     */
    public function getId()
    {
      return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
      return $this->name;
    }

    /**
     * @return string
     */
    public function getLegend()
    {
      return $this->legend;
    }

    /**
     * @return bool
     */
    public function isFirst(): bool
    {
      return $this->first;
    }

    /**
     * @param bool $first
     */
    public function addFirst(bool $first = false)
    {
      $this->first = $first;
    }
  }
