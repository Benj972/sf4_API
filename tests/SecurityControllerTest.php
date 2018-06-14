<?php

namespace tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;

class SecurityControllerTest extends WebTestCase
{
    public function testPOSTCreateToken()
    {
        
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/login_check',
            array(
            '_username' => 'admin@example.com',
            '_password' => 'admin',
        )
        );

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $body = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $body);
        $this->assertInstanceOf(JWTAuthenticationSuccessResponse::class, $client->getResponse());
        $this->assertTrue($client->getResponse()->isSuccessful());
    } 
}