<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query;
use AppBundle\Entity\City;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $base_dir = realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR;

        $query = $this->getDoctrine()
            ->getRepository(City::class)
            ->createQueryBuilder('c')
            ->getQuery();
        $cities = $query->getResult(Query::HYDRATE_ARRAY);

        $popular = file_get_contents($base_dir . "web/popular_city.json");
        $popularCities = json_decode($popular, true)['pop_city'];

        return $this->render('index.html.twig', [
            'cities' => $cities,
            'popular_city' => $popularCities,
            'base_dir' => $base_dir
        ]);
    }

}
