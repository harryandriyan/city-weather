<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;


class WeatherController extends Controller
{
    /**
     * @Route("/weather", name="weather")
     */
    public function indexAction(Request $request)
    {
        $city = $request->query->get('city');
        $city_weather = $this->getCityWeather($city);

        $lat = $city_weather['coord']['lat'];
        $lon = $city_weather['coord']['lon'];
        $near_weather = $this->getNearCityWeather($lat, $lon);

        return $this->render('weather.html.twig', [
            'city_weather' => $city_weather,
            'near_weather' => $near_weather
        ]);
    }

    protected function getCityWeather($city)
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

    protected function getNearCityWeather($lat, $lon)
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
