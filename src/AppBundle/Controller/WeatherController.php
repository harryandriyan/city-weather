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
        $client = new Client();
        $city = $request->query->get('city');
        $uri = 'http://api.openweathermap.org/data/2.5/weather?q='.$city.',au&units=metric&appid=5817b972e7e6c3386e8c3e0d4d937f9a';
        $response = $client->request('GET', $uri);

        $city_weather = [];
        if ($response->hasHeader('Content-Length')) {
            $body = $response->getBody();
            $city_weather = json_decode($body->getContents(), true);
        }

        return $this->render('weather.html.twig', [
            'city_weather' => $city_weather
        ]);
    }
}
