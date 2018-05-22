<?php

namespace App\Handler;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;

class PaginateUsersHandler
{
	/**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * RequestHandler constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
    	$this->manager = $manager;
    }

    public function handle()
    {
        $usersList = $this->manager->getRepository(User::class)->findAll();
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
}