<?php

namespace App\Handler;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;

class PaginateProductsHandler
{
	/**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * RequestHandler constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
    	$this->manager = $manager;
    }

    public function handle()
    {
        $products = $this->manager->getRepository(Product::class)->findAll();
        $paginatedCollection = new PaginatedRepresentation(
            new CollectionRepresentation(
                $products,
                'products',
                'products'
            ),
            'app_product_list', // route
            array(), // route parameters
            1,       // page number
            20,      // limit
            4       // total pages
        );

        return $paginatedCollection;
    }
}