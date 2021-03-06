<?php

namespace App\Handler;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginateProductsHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * PaginateProductsHandler constructor.
     *
     * @param EntityManagerInterface $manager
     * @param RequestStack           $requestStack
     */
    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack)
    {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    public function handle()
    {
        $request = $this->requestStack->getCurrentRequest();
        $page = $request->query->get('page', 1);
        $products = $this->manager->getRepository(Product::class)->getProducts($page, $request->query->get('name'));
        $limit = $request->query->get('limit', 4);
        $numberOfPages = (int) ceil(count($products) / $limit);

        $paginatedCollection = new PaginatedRepresentation(
            new CollectionRepresentation(
                $products,
                'products',
                'products'
            ),
            'app_product_list', // route
            [], // route parameters
            $page,       // page number
            $limit,      // limit
            $numberOfPages       // total pages
        );

        return $paginatedCollection;
    }
}
