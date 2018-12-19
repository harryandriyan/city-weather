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

        return $this->render('index.html.twig', [
            'cities' => $cities,
            'base_dir' => $base_dir
        ]);
    }

}
