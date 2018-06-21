<?php
namespace tests\Unitary;

use PHPUnit\Framework\TestCase;
use App\Controller\UserController;
use App\Entity\User;

class UserControllerTest extends TestCase
{
	public function testCreateAction()
    {
        $validatorHandler = $this
            ->getMockBuilder('App\Handler\ValidatorHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $validatorHandler
            ->expects($this->once())
            ->method('handle')
            ->willReturn(new User());

        $this->assertInstanceOf(User::class, $validatorHandler->handle(new User()));
    }  

    public function testUpdateAction()
    {
    	$validatorHandler = $this
            ->getMockBuilder('App\Handler\ValidatorHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handleUpdate'])
            ->getMock();

        $validatorHandler
            ->expects($this->once())
            ->method('handleUpdate')
            ->willReturn(new User());

        $this->assertInstanceOf(User::class, $validatorHandler->handleUpdate(new User()));
    }

    public function testListUserAction()
    {
        $pageRepresentation = $this
            ->getMockBuilder(PaginatedRepresentation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paginateUsers = $this
            ->getMockBuilder('App\Handler\PaginateUsersHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $paginateUsers
            ->expects($this->once())
            ->method('handle')
            ->willReturn($pageRepresentation);

        $this->assertInstanceOf(PaginatedRepresentation::class, $paginateUsers->handle());
    }

    public function testDeleteAction()
    {
        $deleteHandler = $this
            ->getMockBuilder('App\Handler\DeleteHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $deleteHandler
            ->expects($this->once())
            ->method('handle')
            ->willReturn(NULL);

        $this->assertNull($deleteHandler->handle(new User()));
    }
}