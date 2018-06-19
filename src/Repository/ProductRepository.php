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
        $manager = $this->getEntityManager();
        $query = $manager->createQuery("SELECT p FROM App\Entity\Product p WHERE p.name LIKE '%$name%' ");
        $results = $query->getResult();
        //search product by keyword
        return $results;
    }

    public function getProducts($page, $name)
    {
        $query = $this->createQueryBuilder('p');
        if ($name) {
            $query->where('p.name LIKE :name')->setParameter('name', '%'.$name.'%');
        }

        $query
            // We define the announcement from which to start the list
            ->setFirstResult((($page < 1 ? 1 : $page) - 1) * 4)
            // As well as the number of ads to display on one page
            ->setMaxResults(4)
        ;
        // Finally, we return the Paginator object corresponding to the constructed query
        return new Paginator($query, true);
    }
}
