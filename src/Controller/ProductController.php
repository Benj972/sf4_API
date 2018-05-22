<?php

namespace App\Controller;

use App\Entity\Product;
use App\Handler\PaginateProductsHandler;
use Symfony\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Swagger\Annotations as SWG;

class ProductController extends FOSRestController
{
     /**
     * @Rest\Get(
     *     path = "/products/{id}",
     *     name = "app_product_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View(StatusCode = 200)
     * @SWG\Get(    
     *     description="Get one product.",
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="No route found: Method Not Allowed",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Expired JWT Token/JWT Token not found",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Product object not found: Invalid ID supplied/Invalid Route",
     *     ), 
     *     @SWG\Parameter(
     *          name="id",
     *          required= true,
     *          in="path",
     *          type="integer",
     *          description="The product unique identifier.",
     *     )
     * )
     */
    public function showAction(Product $product)
    {
    	return $product;
    }

    /**
     * @Rest\Get("/products", name="app_product_list")
     *
     * @Rest\View(StatusCode = 200)
     * @SWG\Get(
     *     description="Get the list of products.",
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="No route found: Method Not Allowed",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Expired JWT Token/JWT Token not found",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Invalid Route",
     *     ), 
     * )
     */
    public function listAction(PaginateProductsHandler $handler)
    {
       return $handler->handle();
    }  
}
