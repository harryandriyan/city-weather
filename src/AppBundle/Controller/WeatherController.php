<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;


class WeatherController extends Controller
{
    /**
     * @Route("/weather", name="weather")
     */
    public function indexAction(Request $request)
    {
        $city = $request->query->get('city');
        $weatherService = $this->get('get.weather');
        
        $cityWeather = $weatherService->getWeather($city);

        $lat = $cityWeather['coord']['lat'];
        $lon = $cityWeather['coord']['lon'];

        $nearWeather = $weatherService->getNearWeather($lat, $lon);

        return $this->render('weather.html.twig', [
            'city_weather' => $cityWeather,
            'near_weather' => $nearWeather
        ]);
    }

}
