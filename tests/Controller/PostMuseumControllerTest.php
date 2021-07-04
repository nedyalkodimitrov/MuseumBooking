<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class PostMuseumControllerTest extends WebTestCase
{
    public function testCreateSchedule(): void
    {
        $client = static::createClient([]);

        $client->request(
            'POST',
            '/museum/createSchedule',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"startTime" : "19:00",
        "endTime" : "20:00",
        "museumId" : "1",
        "dayName" : "Monday",
        "price" : "30"}'
        );

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testDeleteSchedule(): void
    {
        $client = static::createClient([]);

        $client->request(
            'POST',
            '/museum/deleteSchedule',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"scheduleId" : "1",}'
        );

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
    public function testUserHasCome(): void
    {
        $client = static::createClient([]);

        $client->request(
            'POST',
            '/museum/userHasCome',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"ticketId" : "1",}'
        );

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testUserHasNotCome(): void
    {
        $client = static::createClient([]);

        $client->request(
            'POST',
            '/museum/userHasNotCome',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"ticketId" : "1",}'
        );

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
    public function testAdditionInformationChange(): void
    {
        $client = static::createClient([]);

        $client->request(
            'POST',
            '/museum/additionInformationChange',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"additionalInformation" : "The beset museum",}'
        );

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
