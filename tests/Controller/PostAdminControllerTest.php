<?php


namespace App\Tests\Controller;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PostAdminControllerTest extends WebTestCase
{
    public function testCreateMuseumAction()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/admin/createMuseumAction',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"name" : "Test",
        "maxCapacity" : "40",
        "city" : "1",
        "email" : "museum@test",
        "password" : "test"'
        );

        $this->assertEquals(Response::HTTP_FOUND , $client->getResponse());

    }
}