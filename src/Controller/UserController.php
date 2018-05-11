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

class UserController extends FOSRestController
{
    /**
	 * @Rest\Get(
	 *		path = "/users/{id}",
	 *		name = "app_user_show",
	 *		requirements = {"id"="\d+"}
	 * )
	 * @Rest\View(StatusCode = 200)
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
     */
    public function createAction(User $user, EntityManagerInterface $manager, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

        $manager->persist($user);
        $manager->flush();

        return $this->view($user, Response::HTTP_CREATED, ['Location' => $this->generateUrl('app_user_show', ['id' => $user->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
    }

    /**
     * @Rest\Put(
     *    path = "/users/{id}",
     *    name = "app_user_update"
     * )
     * @Rest\View(StatusCode = 200)
     * @ParamConverter("updateUser", converter="fos_rest.request_body")
     */
    public function updateAction(User $user, User $updateUser, EntityManagerInterface $manager)
    {
        $user->setEmail($updateUser->getEmail());
        $user->setLastname($updateUser->getLastname());
        $user->setFirstname($updateUser->getFirstname());
        /*$user->setClient($updateUser->getClient());*/

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
     *
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
