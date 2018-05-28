<?php

namespace App\Handler;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack)
    {
    	$this->manager = $manager;
        $this->requestStack = $requestStack; 
    }

    public function handle()
    {
        $request = $this->requestStack->getCurrentRequest();
        $path= $request->getPathInfo();

        if (in_array($path, array('', '/products'))) {
                
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

        } elseif('/products/{name} === $path') {

            $name = $_GET["name"];
            $product = $this->manager->getRepository(Product::class)->getProduct($name);
            if($product != null){
                return $product;
            }
            else {
                throw new BadRequestHttpException('Aucun smartphone ne correspond à votre saisi');
            }
        }
    }
}