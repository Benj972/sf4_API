<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;

class UserController extends FOSRestController
{
    /**
	 * @Rest\Get(
	 *		path = "/users/{id}",
	 *		name = "app_user_show",
	 *		requirements = {"id"="\d+"}
	 * )
	 * @Rest\View
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
     * @Rest\View()
     */
    public function listUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usersList = $em->getRepository('App:User')->findAll();
        return $usersList;
    }


   /* public function createAction()

    public function updateAction()

    public function deleteAction()*/

}
