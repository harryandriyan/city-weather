<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Client;

class WeatherControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/weather?city=Sydney');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
