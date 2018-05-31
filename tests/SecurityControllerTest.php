<?php

namespace tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;

class SecurityControllerTest extends WebTestCase
{
    /*public static $client;

    public function testPOSTCreateToken()
    {
        static::$client = static::createClient();
        $response = static::$client->request('POST','/api/login_check', [
            'auth' => ['admin@example.com', 'admin']
        ]);

        $this->assertSame(200, static::$client->getResponse()->getStatusCode());
        $this->asserter()->assertResponsePropertyExists(
            $response,
            'token'
        );
    }

    public function testGetToken()
    {
        static::$client = static::createClient();
        static::$client->request('POST', 'api/login_check', ['_username' => 'admin@example.com', '_password' => 'admin']);
        $response = static::$client->getResponse();
        $this->assertInstanceOf(JWTAuthenticationSuccessResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $body = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('token', $body, 'The response should have a "token" key containing a JWT Token.');

        $data =
        [
            "_username" => "admin@example.com",
            "_password" => "admin"
        ];

        static::$client->request('POST', '/api/login_check', (array) json_encode($data), [], ['CONTENT_TYPE' => 'application/json']);
        $response = static::$client->getResponse();
        $this->assertInstanceOf(JWTAuthenticationSuccessResponse::class, $response);
    }*/

}