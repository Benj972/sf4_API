<?php
namespace tests\Unitary;

use PHPUnit\Framework\TestCase;
use App\Controller\UserController;
use App\Entity\User;
use Symfony\Component\Validator\ConstraintViolationList;

class UserControllerTest extends TestCase
{
	public function testCreateAction()
    {
        $createHandler = $this
            ->getMockBuilder('App\Handler\CreateRequestHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $createHandler
            ->expects($this->once())
            ->method('handle')
            ->willReturn(new User(), new ConstraintViolationList());

        $this->assertInstanceOf(User::class, $createHandler->handle(new User(), new ConstraintViolationList()));
    }  

    public function testUpdateAction()
    {
    	$updateHandler = $this
            ->getMockBuilder('App\Handler\UpdateRequestHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handleUpdate'])
            ->getMock();

        $updateHandler
            ->expects($this->once())
            ->method('handleUpdate')
            ->willReturn(new User(), new ConstraintViolationList());

        $this->assertInstanceOf(User::class, $updateHandler->handleUpdate(new User(), new ConstraintViolationList()));
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