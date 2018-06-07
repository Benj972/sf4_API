<?php
namespace tests\Unitary;

use PHPUnit\Framework\TestCase;
use App\Controller\ProductController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class ProductControllerTest extends TestCase
{
	public function testListAction()
	{
		$response = new Response;

        $paginateProductsHandler = $this
            ->getMockBuilder('App\Handler\PaginateProductsHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $paginateProductsHandler
            ->method('handle')
            ->willReturn($response);

        $this->assertSame(200, $response->getStatusCode());
	}

	public function testSearchAction()
	{
		$response = new Response;

        $searchHandler = $this
            ->getMockBuilder('App\Handler\SearchHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $searchHandler
            ->method('handle')
            ->willReturn($response);

        $this->assertSame(200, $response->getStatusCode());
	}
}