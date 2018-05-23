<?php

namespace App\Controller;

use App\Entity\User;
use App\Handler\PaginateUsersHandler;
use App\Handler\CreateRequestHandler;
use App\Handler\DeleteHandler;
use App\Handler\ValidatorHandler;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;

class UserController extends FOSRestController
{
    /**
	 * @Rest\Get(
	 *		path = "/users/{id}",
	 *		name = "app_user_show",
	 *		requirements = {"id"="\d+"}
	 * )
	 * @Rest\View(StatusCode = 200)
     * @SWG\Get(    
     *     description="Get one user.",
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
     *         description="User object not found: Invalid ID supplied/Invalid Route",
     *     ), 
     *     @SWG\Parameter(
     *          name="id",
     *          required= true,
     *          in="path",
     *          type="integer",
     *          description="The user unique identifier.",
     *     )
     * )
	 */
    public function viewAction(User $user)
	{
		return $user;
	}

	/**
     * @Rest\Get(
     *     path = "/users",
     *     name = "app_user_list"
     * )
     * @Rest\View(StatusCode = 200)
     * @SWG\Get(
     *     description="Get the list of users.",
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
    public function listUserAction(PaginateUsersHandler $handler)
    {
        return $handler->handle();
    }

    /**
     * @Rest\Post(
     *    path = "/users",
     *    name = "app_user_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter(
     *      "user", 
     *      converter="fos_rest.request_body",
     *      options={
     *          "validator"={ "groups"="Create" }
     *      }
     * )
     * @SWG\Post(
     *     description="Create user",
     *     @SWG\Response(
     *          response=201,
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
    public function createAction(User $user, ValidatorHandler $handler)
    {
        return $handler->handle($user);
    }

    /**
     * @Rest\Put(
     *    path = "/users/{id}",
     *    name = "app_user_update"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter(
     *       options={
     *          "validator"={ "groups"="Update" }
     *      }
     * )
     * @SWG\Put(
     *     description="Update user",
     *     @SWG\Response(
     *          response=201,
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
     *         description="User object not found: Invalid ID supplied/Invalid Route",
     *     ),
     *     @SWG\Parameter(
     *          name="id",
     *          required= true,
     *          in="path",
     *          type="integer",
     *          description="The user unique identifier.",
     *     ) 
     * )
     */
    public function updateAction(User $user, ValidatorHandler $handler)
    {
        return $handler->handleUpdate($user);
    }

    /**
     * @Rest\Delete(
     *     path = "/users/{id}",
     *     name = "app_user_delete",
     *     requirements = { "id" = "\d+" }
     * )
     *
     * @Rest\View(
     *     statusCode = 204
     * )
     * @SWG\Delete(
     *     description="Delete user",
     *     @SWG\Response(
     *          response=204,
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
     *         description="User object not found: Invalid ID supplied/Invalid Route",
     *     ),
     *     @SWG\Parameter(
     *          name="id",
     *          required= true,
     *          in="path",
     *          type="integer",
     *          description="The user unique identifier.",
     *     ) 
     * )
     */
    public function deleteAction(User $user, DeleteHandler $handler)
    {
        return $handler->handle($user);
    }
}
