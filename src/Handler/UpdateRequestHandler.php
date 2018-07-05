<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Entity\User;

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
     * @var RequestStack
     */
    private $requestStack;

    /**
     * UpdateRequestHandler constructor.
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

    public function handleUpdate($user, $violations)
    {
        if (count($violations)) {
            throw new BadRequestHttpException($violations);
        }
        $request = $this->requestStack->getCurrentRequest();
        $userUpdate = $this->manager->getRepository(User::class)-> find($request->attributes->get('id'));
        $userUpdate->setEmail($user->getEmail());
        $userUpdate->setLastname($user->getLastname());
        $userUpdate->setFirstname($user->getFirstname());
        $userUpdate->setClient($this->tokenStorage->getToken()->getUser());
        $this->manager->persist($userUpdate);
        $this->manager->flush();

        return $userUpdate;
    }
}