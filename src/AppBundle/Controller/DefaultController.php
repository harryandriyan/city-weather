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
        $em = $this->get('doctrine')->getManager();
        $cities = $em->getRepository("AppBundle:City")->findAll();
        $listCity = [];

        foreach ($cities as $list) {
            $listCity[] = [
                'id' => $list->getId(),
                'city' => $list->getCity()
            ];
        }

        return $this->render('index.html.twig', [
            'cities' => $listCity,
            'base_dir' => $base_dir
        ]);
    }

}
