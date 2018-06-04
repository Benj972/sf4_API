<?php
namespace tests;

use App\Controller\ProductController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Product;
use Symfony\Component\DomCrawler\Crawler;

class ProductControllerTest extends WebTestCase
{
    protected function createAuthenticatedClient($username = 'admin@example.com', $password = 'admin')
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/login_check',
            array(
            '_username' => $username,
            '_password' => $password,
        )
        );

        $data = json_decode($client->getResponse()->getContent(), true);
        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data["token"]));

        return $client;
    }


    public function setUp()
    {
        $this->secondClient = static::createClient();
    }

    public function testGetProductWithoutToken()
    {
        $crawler = $this->secondClient->request('GET', '/products');
        $this->assertSame(401, $this->secondClient->getResponse()->getStatusCode());
    }

    public function testGetProductWithToken()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/products');
        $this->assertSame(200, $client->getResponse()->getStatusCode());     
    } 

    public function testGetProductbyNameWithToken()
    {
        $client = $this->createAuthenticatedClient();
        $name = [
            'name' => 'phone',
        ];
        $crawler = $client->request('GET', '/products', $name);
        $this->assertSame(200, $client->getResponse()->getStatusCode()); 
        $body = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('pages', $body);
        $this->assertContains(4, $body);
    } 


    public function testGetOneProductWithToken()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/products/13');
        
        $this->assertSame(200, $client->getResponse()->getStatusCode());  

        $body = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('name', $body);   
    } 

    public function testGetOneProductWithoutToken()
    {
        $crawler = $this->secondClient->request('GET', '/products/13');
        $this->assertSame(401, $this->secondClient->getResponse()->getStatusCode());
    }

    public function testGetSearchProduct()  
    {
         $client = $this->createAuthenticatedClient();
         $crawler = $client->request(
            'POST',
            '/search',
            array(
            'name' => 'phone',
        )
        );

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testGetSearchFalseProduct()  
    {
         $client = $this->createAuthenticatedClient();
         $crawler = $client->request(
            'POST',
            '/search',
            array(
            'name' => 'test',
        )
        );

        $this->assertSame(400, $client->getResponse()->getStatusCode());
    }
}