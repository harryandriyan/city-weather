<?php

namespace AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;

class WeatherService
{
    public function getWeather($city)
    {
        $client = new Client();
        $uri = 'http://api.openweathermap.org/data/2.5/weather?q='.$city.',au&units=metric&appid=5817b972e7e6c3386e8c3e0d4d937f9a';
        $response = $client->request('GET', $uri);

        $city_weather = [];
        if ($response->hasHeader('Content-Length')) {
            $body = $response->getBody();
            $city_weather = json_decode($body->getContents(), true);
        }

        return $city_weather;
    }

    public function getNearWeather($lat, $lon)
    {
        $client = new Client();
        $uri = 'http://api.openweathermap.org/data/2.5/find?lat='.$lat.'&lon='.$lon.'&cnt=21&units=metric&appid=5817b972e7e6c3386e8c3e0d4d937f9a';
        $response = $client->request('GET', $uri);

        $near_weather = [];
        if ($response->hasHeader('Content-Length')) {
            $body = $response->getBody();
            $near_weather = json_decode($body->getContents(), true);
            unset($near_weather['list'][0]);
        }

        return $near_weather['list'];
    }
}
