<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MuseumController extends AbstractController
{
    /**
     * @Route("/museum", name="museum")
     */
    public function home()
    {
        return $this->render('museum/museumBase.html.twig', [
            'controller_name' => 'MuseumController',
        ]);
    }
    /**
     * @Route("/museum/settings", name="museum_settings")
     */
    public function museumSettings()
    {
        return $this->render('museum/settings/settings.html.twig', [
            'controller_name' => 'MuseumController',
        ]);
    }
    /**
     * @Route("/museum/schedule", name="museum_schedule")
     */
    public function schedule()
    {
        return $this->render('museum/schedule/schedule.html.twig', [
            'controller_name' => 'MuseumController',
        ]);
    }

}
