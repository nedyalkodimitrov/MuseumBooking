<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TourOperatorController extends AbstractController
{
    /**
     * @Route("/tour/operator", name="tour_operator")
     */
    public function index()
    {
        return $this->render('tour_operator/index.html.twig', [
            'controller_name' => 'TourOperatorController',
        ]);
    }
}
