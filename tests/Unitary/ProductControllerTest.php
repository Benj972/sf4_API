<?php
namespace tests\Unitary;

use PHPUnit\Framework\TestCase;
use App\Controller\ProductController;
use Hateoas\Representation\PaginatedRepresentation;
use App\Entity\Product;

class ProductControllerTest extends TestCase
{
	public function testListAction()
	{
        $paginatedRepresentation = $this
            ->getMockBuilder(PaginatedRepresentation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paginateProductsHandler = $this
            ->getMockBuilder('App\Handler\PaginateProductsHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $paginateProductsHandler
            ->expects($this->once())
            ->method('handle')
            ->willReturn($paginatedRepresentation);
        /*echo print_r($paginateProductsHandler->handle());*/
        $this->assertInstanceOf(PaginatedRepresentation::class, $paginateProductsHandler->handle());
	}

	public function testSearchAction()
	{
        $searchHandler = $this
            ->getMockBuilder('App\Handler\SearchHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $searchHandler
            ->expects($this->once())
            ->method('handle')
            ->willReturn(new Product());

        $this->assertInstanceOf(Product::class, $searchHandler->handle());
	}
}