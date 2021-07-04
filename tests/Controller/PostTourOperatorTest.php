<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;

class PostTourOperatorTest extends TestCase
{
    public function testBookTicket(): void
    {
        $client = static::createClient([]);

        $client->request(
            'POST',
            '/tourOperator/bookTicket',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"scheduleId" : "1",}'
        );

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
