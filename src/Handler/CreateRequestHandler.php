<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateRequestHandler
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
     *
     * @param EntityManagerInterface $manager
     * @param TokenStorageInterface  $tokenStorage
     * @param RequestStack           $requestStack
     */
    public function __construct(EntityManagerInterface $manager, TokenStorageInterface $tokenStorage, RequestStack $requestStack)
    {
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
    }

    public function handle($user, $violations)
    {
        if (count($violations)) {
            throw new BadRequestHttpException($violations);
        }

        $user->setClient($this->tokenStorage->getToken()->getUser());
        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }
}
