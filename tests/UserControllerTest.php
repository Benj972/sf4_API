<?php
namespace tests;

use App\Controller\UserController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
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
        $crawler = $this->secondClient->request('GET', '/users');
        $this->assertSame(401, $this->secondClient->getResponse()->getStatusCode());
    }

    public function testGetUserWithToken()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/users');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }  

    public function testGetOneUserWithToken()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/users/5');
        $this->assertSame(200, $client->getResponse()->getStatusCode());   
    } 

    public function testGetOneUserWithoutToken()
    {
        $crawler = $this->secondClient->request('GET', '/users/5');
        $this->assertSame(401, $this->secondClient->getResponse()->getStatusCode());  
    }

    public function testDeleteUser()
    {
        $client = $this->createAuthenticatedClient();
        $response = $client->request('DELETE', '/users/50');
        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }

    public function testCreateUser()
    {
        $client = $this->createAuthenticatedClient();

        $data =
        '
        {
            "email": "test61@hotmail.fr",
            "lastname": "testlastname61",
            "firstname":"testfirstanme61"
        }
        ';
        $crawler = $client->request('POST', '/users', (array) json_decode($data), [], ['CONTENT_TYPE' => 'application/json']);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }

    public function testUpdateUser()
    {
        $client = $this->createAuthenticatedClient();

        $data =
        '
        {
            "email": "test4@hotmail.fr",
            "lastname": "testlastname",
            "firstname":"testfirstanme"
        }
        ';

        $crawler = $client->request('PUT', '/users/5', (array) json_decode($data), [], ['CONTENT_TYPE' => 'application/json']); 
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }
}