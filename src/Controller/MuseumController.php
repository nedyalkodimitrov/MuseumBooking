<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MuseumController extends AbstractController
{
    /**
     * @Route("/museum", name="museum")
     */
    public function index()
    {
        return $this->render('museum/index.html.twig', [
            'controller_name' => 'MuseumController',
        ]);
    }
}
