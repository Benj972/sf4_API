<?php
namespace tests;

use App\Controller\ProductController;
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
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\Filesystem\Filesystem;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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


    /*public function setUp()
    {
        $this->client = static::createClient(array(), array(
        'PHP_AUTH_USER' => 'admin@example.com',
        'PHP_AUTH_PW'   => 'admin',
        ));

        $this->secondClient = static::createClient();
    }*/

    /*public function testGetProductWithoutToken()
    {
        $crawler = $this->secondClient->request('GET', '/products');
        $this->assertSame(401, $this->secondClient->getResponse()->getStatusCode());
    }*/

    /*public function testGetProductWithToken()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/products');

        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    } */ 

    /*public function testGetOneProductWithToken()

    public function testGetOneProductWithoutToken()

    public function testGetSearchProduct()  */
}