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
        $pageRepresentation = $this
            ->getMockBuilder(PaginatedRepresentation::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paginateProducts = $this
            ->getMockBuilder('App\Handler\PaginateProductsHandler')
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $paginateProducts
            ->expects($this->once())
            ->method('handle')
            ->willReturn($pageRepresentation);
       
        $this->assertInstanceOf(PaginatedRepresentation::class, $paginateProducts->handle());
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