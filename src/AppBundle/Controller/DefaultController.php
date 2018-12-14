<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $base_dir = realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;
        $json_cities = file_get_contents($base_dir . "web/city.json");
        $cities = json_decode($json_cities, true)['city'];
        //echo json_encode($cities); die();

        return $this->render('index.html.twig', [
            'base_dir' => $base_dir,
            'cities' => $cities
        ]);
    }

}
