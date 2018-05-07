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

    /**
     * @Rest\Post(
     *    path = "/users",
     *    name = "app_user_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function createAction(User $user)
    {
    	$em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();

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
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->findOneById($id);
        if ($user) {
            $em->remove($user);
            $em->flush();
        }
        return;
    }
}
