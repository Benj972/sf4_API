<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintViolationList;
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
    public function listUserAction(EntityManagerInterface $manager)
    {
        $usersList = $manager->getRepository(User::class)->findAll();
        $paginatedCollection = new PaginatedRepresentation(
            new CollectionRepresentation(
                $usersList,
                'usersList',
                'usersList'
            ),
            'app_user_list', // route
            array(), // route parameters
            1,       // page number
            20,      // limit
            4       // total pages
        );

        return $paginatedCollection;
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
    public function createAction(User $user, EntityManagerInterface $manager, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }
        $user->setClient($this->getUser());
        $manager->persist($user);
        $manager->flush();

        return $this->view($user, Response::HTTP_CREATED, ['Location' => $this->generateUrl('app_user_show', ['id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
    }

    /**
     * @Rest\Put(
     *    path = "/users/{id}",
     *    name = "app_user_update"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter(
     *      "updateUser",
     *       converter="fos_rest.request_body",
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
    public function updateAction(User $user, User $updateUser, EntityManagerInterface $manager, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

        $user->setEmail($updateUser->getEmail());
        $user->setLastname($updateUser->getLastname());
        $user->setFirstname($updateUser->getFirstname());
        $user->setClient($this->getUser());
        
        $manager->persist($user);
        $manager->flush();

        return $this->view($user, Response::HTTP_CREATED, ['Location' => $this->generateUrl('app_user_show', ['id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
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
    public function deleteAction(User $user, EntityManagerInterface $manager)
    {
        if ($user) {
            $manager->remove($user);
            $manager->flush();
        }
        return;
    }
}
