<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\RequestStack;

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
     * RequestHandler constructor.
     * @param EntityManagerInterface $manager
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManagerInterface $manager, TokenStorageInterface $tokenStorage)
    {
        $this->manager = $manager;
    	$this->tokenStorage = $tokenStorage;    
    }

    public function handle($user)
    {
        $this->validate();

        $client = $this->tokenStorage->getToken()->getUser();
        $user->setClient($client);
        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
        
    }

    /**
     * @return Response
     */
    public abstract function validate();

}