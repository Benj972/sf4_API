<?php

namespace App\Handler;

use App\Handler\CreateRequestHandler;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ValidatorHandler extends CreateRequestHandler
{	
    /**
     * ValidatorHandler constructor.
     * @param EntityManagerInterface $manager
     * @param TokenStorageInterface $tokenStorage
     * @param RequestStack $requestStack
     */
	public function __construct(EntityManagerInterface $manager, TokenStorageInterface $tokenStorage, RequestStack $requestStack)
    {
        parent::__construct($manager, $tokenStorage, $requestStack);
        $this->requestStack = $requestStack;
    }

	public function validate()	
	{
		$request = $this->requestStack->getCurrentRequest();
        $array = array(
        'email' => $request->request->get('email'), 
        'lastname' => $request->request->get('lastname'),  
        'firstname' => $request->request->get('firstname'),
        );

        $constraint = new Assert\Collection(array(
        // the keys correspond to the keys in the input array
        'email' => new Assert\NotBlank(),
        'lastname' => new Assert\NotBlank(),
        'firstname' => new Assert\NotBlank(),
        ));

        $validator = Validation::createValidator();  
        $violations = $validator->validate($array, $constraint);

        if (count($violations)>0) {
            throw new BadRequestHttpException($violations);
        }
    }
}