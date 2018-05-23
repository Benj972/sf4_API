<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteHandler 
{
	/**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * DeleteHandler constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
    	$this->manager = $manager;
    }

    public function handle($user)
    {
        if ($user) {
            $this->manager->remove($user);
            $this->manager->flush();
        }
        return;
    }
}