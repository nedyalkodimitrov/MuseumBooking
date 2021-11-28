<?php

namespace App\Controller\TourOperator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    private const  ImagePath = "images/tourOperator/";

    protected function customRenderView($view, $params = [])
    {
        $tourOperator  = $this->getUser()->getTourOperator();
        $params += ['userName' => $tourOperator->getName()];
        $params += ['userImage' => self::ImagePath.$tourOperator->getImage()];

        return $this->render($view, $params);
    }
}
