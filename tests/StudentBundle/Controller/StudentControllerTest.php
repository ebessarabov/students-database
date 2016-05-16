<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Client;

/**
 * Class StudentControllerTest
 * @package StudentBundle\Controller
 */
class StudentControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;


    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testRandomPage()
    {
        $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isRedirect());
        $crawler = $this->client->followRedirect();
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf(
            'DateTime',
            $response->getExpires()
        );
    }

    public function testInfoPage()
    {
        $this->client->request(Request::METHOD_GET, "students/detail/alverta_olson_1");
        $response = $this->client->getResponse();
        $this->assertTrue($response->isSuccessful());
        $this->assertInstanceOf(
            'DateTime',
            $response->getExpires()
        );
    }
}
