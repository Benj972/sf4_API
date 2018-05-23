<?php

namespace App\Handler;

use App\Entity\Product;
use App\Handler\CreateRequestHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;

class SearchHandler 
{	

   /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * Search Handler constructor.
     * @param EntityManagerInterface $manager
     * @param TokenStorageInterface $tokenStorage
     * @param RequestStack $requestStack
     */
    public function __construct(EntityManagerInterface $manager, TokenStorageInterface $tokenStorage, RequestStack $requestStack)
    {
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
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