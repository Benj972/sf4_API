<?php

namespace App\Controller;

use App\Entity\Product;
use App\Handler\PaginateProductsHandler;
use App\Handler\SearchHandler;
use Symfony\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class ProductController extends FOSRestController
{
    /**
     * @Rest\Get(
     *     path = "/products/{id}",
     *     name = "app_product_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200)
     * @Cache(maxage="3600", public=true, mustRevalidate=true)
     * @SWG\Get(
     *     description="Get one product.",
     *     tags = {"Product"},
     *     @SWG\Response(
     *          response=200,
     *          @Model(type=Product::class),
     *          description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Bad Request: Method Not Allowed",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized: Expired JWT Token/JWT Token not found",
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
     *     ),
     *     @SWG\Parameter(
     *          name="Authorization",
     *          required= true,
     *          in="header",
     *          type="string",
     *          description="Bearer Token",
     *     )
     * )
     */
    public function showAction(Product $product)
    {
        return $product;
    }

    /**
     * @Rest\Get(
     *     path = "/products",
     *     name="app_product_list"
     * )
     * @Rest\View(StatusCode = 200)
     * @Cache(maxage="3600", public=true, mustRevalidate=true)
     * @SWG\Get(
     *     description="Get the list of products.",
     *     tags = {"Product"},
     *     @SWG\Response(
     *          response=200,
     *          @Model(type=Product::class),
     *          description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Bad Request: Method Not Allowed",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized: Expired JWT Token/JWT Token not found",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not Found: Invalid Route",
     *     ),
     *     @SWG\Parameter(
     *          name="name",
     *          required= false,
     *          in="query",
     *          type="string",
     *          description="Search product by name in list products",
     *     ),
     *     @SWG\Parameter(
     *          name="Authorization",
     *          required= true,
     *          in="header",
     *          type="string",
     *          description="Bearer Token",
     *     )
     * )
     */
    public function listAction(PaginateProductsHandler $handler)
    {
        return $handler->handle();
    }

    /**
     * @Rest\Post("/search", name="search_product")
     *
     * @Rest\View(StatusCode = 200)
     * @SWG\Post(
     *     description="Search product by Keyword.",
     *     tags = {"Product"},
     *     @SWG\Response(
     *         response=201,
     *         description="successful operation",
     *         @Model(type=Product::class)
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad Request: Product is unavailable",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized: Expired JWT Token/JWT Token not found",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not Found: Invalid Route",
     *     ),
     *     @SWG\Parameter(
     *          name="Authorization",
     *          required= true,
     *          in="header",
     *          type="string",
     *          description="Bearer Token",
     *     ),
     *     @SWG\Parameter(
     *          name="Body",
     *          required= true,
     *          in="body",
     *          type="string",
     *          description="Parameter name to add",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=Product::class, groups={"search_body"})
     *          )
     *      )
     * )
     */
    public function searchAction(SearchHandler $handler)
    {
        return $handler->handle();
    }
}
