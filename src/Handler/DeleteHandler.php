<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;

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