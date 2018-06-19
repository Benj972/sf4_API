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
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class UserController extends FOSRestController
{
    /**
	* @Rest\Get(
	*		path = "/users/{id}",
	*		name = "app_user_show",
	*		requirements = {"id"="\d+"}
	* )
	* @Rest\View(StatusCode = 200)
     * @Cache(maxage="3600", public=true, mustRevalidate=true)
     * @SWG\Get(    
     *     description="Get one user.",
     *     tags = {"User"},
     *     @SWG\Response(
     *          response=200,
     *          @Model(type=User::class),
     *          description="Successful operation",
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
     *         description="User object not found: Invalid ID supplied/Invalid Route",
     *     ), 
     *     @SWG\Parameter(
     *          name="id",
     *          required= true,
     *          in="path",
     *          type="integer",
     *          description="The user unique identifier.",
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
     * @Cache(maxage="3600", public=true, mustRevalidate=true)
     * @SWG\Get(
     *     description="Get the list of users.",
     *     tags = {"User"},
     *     @SWG\Response(
     *          response=200,
     *          @Model(type=User::class),
     *          description="Successful operation",
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
     *          name="Authorization",
     *          required= true,
     *          in="header",
     *          type="string",
     *          description="Bearer Token",
     *     )
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
     *      converter="fos_rest.request_body"
     * )
     * @SWG\Post(
     *     description="Create user",
     *     tags = {"User"},
     *     @SWG\Response(
     *          response=201,
     *          @Model(type=User::class),
     *          description="Successful operation",
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
     *          description="All property user to add",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=User::class, groups={"user"})
     *          )
     *      )
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
     * @SWG\Put(
     *     description="Update user",
     *     tags = {"User"},
     *     @SWG\Response(
     *          response=201,
     *          @Model(type=User::class),
     *          description="Successful operation",
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
     *         description="User object not found: Invalid ID supplied/Invalid Route",
     *     ),
     *     @SWG\Parameter(
     *          name="id",
     *          required= true,
     *          in="path",
     *          type="integer",
     *          description="The user unique identifier.",
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
     *          description="Change one or all property user",
     *          @SWG\Schema(
     *              type="array",
     *              @Model(type=User::class, groups={"user"})
     *          )
     *      ) 
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
     *     tags = {"User"},
     *     @SWG\Response(
     *          response=204,
     *          description="Successful operation",
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
     *         description="User object not found: Invalid ID supplied/Invalid Route",
     *     ),
     *     @SWG\Parameter(
     *          name="id",
     *          required= true,
     *          in="path",
     *          type="integer",
     *          description="The user unique identifier.",
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
    public function deleteAction(User $user, DeleteHandler $handler)
    {
        return $handler->handle($user);
    }
}