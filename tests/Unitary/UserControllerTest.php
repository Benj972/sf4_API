<?php
namespace tests\Unitary;

use PHPUnit\Framework\TestCase;
use App\Controller\UserController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends TestCase
{
	public function testCreateAction()
    {
    	$response = new Response;

    	$validatorHandler = $this
            ->getMockBuilder('App\Handler\ValidatorHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $validatorHandler
            ->method('handle')
            ->willReturn($response);

        $this->assertSame(200, $response->getStatusCode());
    }  

    public function testUpdateAction()
    {
    	$response = new Response;

    	$validatorHandler = $this
            ->getMockBuilder('App\Handler\ValidatorHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handleUpdate'])
            ->getMock();

        $validatorHandler
            ->method('handleUpdate')
            ->willReturn($response);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testListUserAction()
    {
        $response = new Response;

        $paginateUsersHandler = $this
            ->getMockBuilder('App\Handler\PaginateUsersHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $paginateUsersHandler
            ->method('handle')
            ->willReturn($response);

        $this->assertSame(200, $response->getStatusCode());
    }

    public function testDeleteAction()
    {
        $response = new Response;

        $deleteHandler = $this
            ->getMockBuilder('App\Handler\DeleteHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $deleteHandler
            ->method('handle')
            ->willReturn($response);

        $this->assertSame(200, $response->getStatusCode());
    }
}