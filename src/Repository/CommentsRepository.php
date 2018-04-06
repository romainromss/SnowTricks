<?php
declare(strict_types=1);

namespace App\Repository;

use App\Domain\Models\Comments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CommentsRepository
 *
 * @package App\Repository
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentsRepository extends ServiceEntityRepository
{
    /**
     * CommentsRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comments::class);
    }
}
