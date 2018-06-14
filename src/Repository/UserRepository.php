<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUsers($page)
    {
        $query = $this->createQueryBuilder('u')
            ->getQuery()
        ;
        $query
            // We define the announcement from which to start the list
            ->setFirstResult((($page<1 ? 1 : $page)-1) * 4)
            // As well as the number of ads to display on one page
            ->setMaxResults(4)
        ;
        // Finally, we return the Paginator object corresponding to the constructed query
        return new Paginator($query, true);
    }
}
