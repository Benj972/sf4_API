<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UpdateRequestHandler 
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

    public function handle($user, $updateUser, $violations)
    {
        if (count($violations)) {
            throw new BadRequestHttpException($violations);
        }

        $user->setEmail($updateUser->getEmail());
        $user->setLastname($updateUser->getLastname());
        $user->setFirstname($updateUser->getFirstname());
        $client = $this->tokenStorage->getToken()->getUser();
        $user->setClient($client);
        
        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }
}