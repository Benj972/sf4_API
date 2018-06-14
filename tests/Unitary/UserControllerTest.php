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
            ->expects($this->exactly(2))
            ->method('handle')
            ->willReturn(new User());

        $this->assertInstanceOf(User::class, $validatorHandler->handle(new User()));

        $userController = new UserController();
        
        $user = $userController->createAction(new User(), $validatorHandler);

        $this->assertEquals(new User(), $user);
    }  

    public function testUpdateAction()
    {
    	$validatorHandler = $this
            ->getMockBuilder('App\Handler\ValidatorHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handleUpdate'])
            ->getMock();

        $validatorHandler
            ->expects($this->exactly(2))
            ->method('handleUpdate')
            ->willReturn(new User());

        $this->assertInstanceOf(User::class, $validatorHandler->handleUpdate(new User()));

        $userController = new UserController();
        
        $user = $userController->updateAction(new User(), $validatorHandler);

        $this->assertEquals(new User(), $user);
    }

    public function testListUserAction()
    {
        $paginatedRepresentation = $this
            ->getMockBuilder(PaginatedRepresentation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paginateUsersHandler = $this
            ->getMockBuilder('App\Handler\PaginateUsersHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $paginateUsersHandler
            ->expects($this->once())
            ->method('handle')
            ->willReturn($paginatedRepresentation);

        $this->assertInstanceOf(PaginatedRepresentation::class, $paginateUsersHandler->handle());
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