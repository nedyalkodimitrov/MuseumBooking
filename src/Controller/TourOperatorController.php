<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TourOperatorController extends AbstractController
{
    /**
     * @Route("/tourOperator", name="tour_operator")
     */
    public function home()
    {
        return $this->render('tour_operator/home/index.html.twig', [
            'controller_name' => 'TourOperatorController',
        ]);
    }
    /**
     * @Route("/tourOperator/settings", name="tour_operator_schedule")
     */
    public function settings()
    {
        return $this->render('tour_operator/schedule/schedule.html.twig', [
            'controller_name' => 'TourOperatorController',
        ]);
    }
    /**
     * @Route("/tourOperator/museum", name="tour_operator_settings")
     */
    public function museum()
    {
        return $this->render('tour_operator/settings/settings.html.twig', [
            'controller_name' => 'TourOperatorController',
        ]);
    }

}
