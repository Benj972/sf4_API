<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

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
}
