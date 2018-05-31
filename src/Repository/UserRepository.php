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
            // On définit l'annonce à partir de laquelle commencer la liste
            ->setFirstResult((($page<1 ? 1 : $page)-1) * 4)
            // Ainsi que le nombre d'annonce à afficher sur une page
            ->setMaxResults(4)
        ;
        // Enfin, on retourne l'objet Paginator correspondant à la requête construite
        return new Paginator($query, true);
    }
}
