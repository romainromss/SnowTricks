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

namespace App\Domain\Repository;

use App\Domain\Models\Comments;
use App\Domain\Repository\Interfaces\CommentsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CommentsRepository.
 *
 * @author Romain Bayette <romain.romss@gmail.com>
 */
class CommentsRepository extends ServiceEntityRepository implements CommentsRepositoryInterface
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

    /**
     * @param $comments
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($comments)
    {
        $this->getEntityManager()->persist($comments);
        $this->getEntityManager()->flush();
    }
}
