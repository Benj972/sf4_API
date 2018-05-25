<?php
namespace tests;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Product;
use Symfony\Component\DomCrawler\Crawler;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Hateoas\Configuration\Annotation as Hateoas;

class TricksControllerTest extends WebTestCase
{
    private $client = null;
    
    public function setUp()
    {
        $this->client = static::createClient(array(), array(
        'PHP_AUTH_USER' => 'admin@example.com',
        'PHP_AUTH_PW'   => 'admin',
        ));
    }

    public function testGetProductWithoutToken()
    {
    /*
    $this->execQuery($this->client, 'GET', null, '/products');
    $response = $this->client->getResponse();
    $this->assertJsonResponse($response, 401);
    */
    }
}