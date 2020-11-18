<?php

namespace App\Controller\TourOperator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class tourOperatorPostController extends AbstractController
{
    /**
     * @Route("/tour/operator/tour/operator/post", name="tour_operator_tour_operator_post")
     */
    public function index()
    {
        return $this->render('tour_operator/tour_operator_post/index.html.twig', [
            'controller_name' => 'tourOperatorPostController',
        ]);
    }
}
