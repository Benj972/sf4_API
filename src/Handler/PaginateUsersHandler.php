<?php

namespace App\Handler;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginateUsersHandler
{
	/**
     * @var EntityManagerInterface
     */
    private $manager;

     /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * PaginateUserHandler constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack)
    {
    	$this->manager = $manager;
        $this->requestStack = $requestStack; 
    }

    public function handle()
    {
        $request = $this->requestStack->getCurrentRequest();
        $page = $request->query->get('page', 1);
        $usersList = $this->manager->getRepository(User::class)->getUsers($page);
        $limit = 4;
        $numberOfPages = (int) ceil(count($usersList) / $limit);
        $paginatedCollection = new PaginatedRepresentation(
            new CollectionRepresentation(
                $usersList,
                'usersList',
                'usersList'
            ),
            'app_user_list', // route
            array(), // route parameters
            $page,       // page number
            $limit,      // limit
            $numberOfPages     // total pages
        );

        return $paginatedCollection;
    }
}