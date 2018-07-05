<?php
namespace tests;

use App\Controller\UserController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
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

    public function testGetUserWithoutToken()
    {
        $this->secondClient->request('GET', '/users');
        $this->assertSame(401, $this->secondClient->getResponse()->getStatusCode());
    }

    public function testGetUserWithToken()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/users');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }  

    public function testGetOneUserWithToken()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/users/1');
        $this->assertSame(200, $client->getResponse()->getStatusCode());   
    } 

    public function testGetOneUserWithoutToken()
    {
        $this->secondClient->request('GET', '/users/1');
        $this->assertSame(401, $this->secondClient->getResponse()->getStatusCode());  
    }

    public function testNegativeDeleteUser()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('DELETE', '/users/150');
        // id user is not good
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testCreateUser()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('POST', '/users',[],[],['CONTENT_TYPE' => 'application/json'],json_encode([
            "email" => "test40@hotmail.fr",
            "lastname" => "testlastname40",
            "firstname" => "testfirstanme40"
            ])
        );
        
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }

    public function testUpdateUser()
    {
        $client = $this->createAuthenticatedClient();

        $client->request('PUT', '/users/1',[],[],['CONTENT_TYPE' => 'application/json'],json_encode([
            "email" => "test@hotmail.fr",
            "lastname" => "testlastname",
            "firstname" => "testfirstanme"
            ])
        );
 
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
}