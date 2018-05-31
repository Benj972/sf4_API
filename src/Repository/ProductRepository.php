<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProduct($name)
    {
        $em = $this->getEntityManager();    
        $query = $em->createQuery("SELECT p FROM App\Entity\Product p WHERE p.name LIKE '%$name%' ");
        $results = $query->getResult();
        //search product by keyword 
        return $results;
    }

    public function getProducts($page)
    {
        $query = $this->createQueryBuilder('p')
            ->getQuery()
        ;
        $query
            // On définit l'annonce à partir de laquelle commencer la liste
            ->setFirstResult((($page<1 ? 1 : $page)-1) * 4)
            // Ainsi que le nombre d'annonce à afficher sur une page
            ->setMaxResults(4)
        ;
        // Enfin, on retourne l'objet Paginator correspondant à la requête construite
        // (n'oubliez pas le use correspondant en début de fichier)
        return new Paginator($query, true);
    }
}
