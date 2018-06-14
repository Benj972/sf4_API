<?php

namespace App\Handler;

use App\Entity\Product;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;

class SearchHandler 
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
     * Search Handler constructor.
     * @param EntityManagerInterface $manager
     * @param RequestStack $requestStack
     */
    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack)
    {
        $this->manager = $manager;
        $this->requestStack = $requestStack;  
    }

	public function handle()	
	{
	   $request = $this->requestStack->getCurrentRequest();
       $name = $request->request->get('name');
       $product = $this->manager->getRepository(Product::class)->getProduct($name);

       if (!$product) {
            throw new BadRequestHttpException('Le produit est indisponible');
       }
       return $product;
    }
}