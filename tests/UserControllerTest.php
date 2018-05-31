<?php
namespace tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Tests\Server;
use App\Controller\UserController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use App\Entity\User;
use App\Handler\PaginateUsersHandler;
use App\Handler\CreateRequestHandler;
use App\Handler\DeleteHandler;
use App\Handler\ValidatorHandler;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/*use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;*/
use Swagger\Annotations as SWG;


class UserControllerTest extends WebTestCase
{
    /*protected function createAuthenticatedClient($username = 'admin@example.com', $password = 'admin')
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
        $this->client = static::createClient(array(), array(
        'PHP_AUTH_USER' => 'admin@example.com',
        'PHP_AUTH_PW'   => 'admin',
        ));

        $this->secondClient = static::createClient();
    }

    public function testGetUserWithoutToken()
    {
        $crawler = $this->secondClient->request('GET', '/users');
        $this->assertSame(401, $this->secondClient->getResponse()->getStatusCode());
    }

    public function testGetUserWithToken()
    {
        
    }  

    public function testGetOneUserWithToken()
    {}
    public function testGetOneUserWithoutToken()
    {}
    public function testDeleteUser()
    {
        $response = $this->client->delete('/users/{id}');

        $this->assertEquals(200, $response->getStatusCode());
    }
*/
    /*public function testCreateUser()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8000/']);

        $data = array(
        'email' => 'test@hotmail.fr',
        'lastname' => 'testlastname',
        'firstname' => 'testfirtsname',
        );

        $request = $client->post('/users', null, json_encode($data));
        $response = $request->send();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('content-type'));
        $data = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('test@hotmail.fr', $data);
    }*/
}