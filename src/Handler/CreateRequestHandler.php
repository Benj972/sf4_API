<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\User;

abstract class CreateRequestHandler 
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
     * CreateRequestHandler constructor.
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

    public function handle($user)
    {
        $this->validate();
        $user->setClient($this->tokenStorage->getToken()->getUser());
        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
        
    }

    public function handleUpdate($user)
    {
        $this->validate();
        $request = $this->requestStack->getCurrentRequest();
        $user->setEmail($request->request->get('email'));
        $user->setLastname($request->request->get('lastname'));
        $user->setFirstname($request->request->get('firstname'));
        $user->setClient($this->tokenStorage->getToken()->getUser());
        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }

    /**
     * @return Response
     */
    public abstract function validate();
}