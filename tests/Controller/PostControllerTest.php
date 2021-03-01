<?php


namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
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

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
}