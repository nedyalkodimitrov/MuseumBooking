<?php

namespace App\Controller;

use App\Repository\MuseumRepository;
use App\Repository\TourOperatorRepository;
use App\Service\CustomSerializer;
use App\Service\SearchMuseum;
use App\Service\SearchTourOperator;
use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/searchEngine/{data}", name="searchEngine")
     */
    public function searchEngine($data,CustomSerializer $serializer, SearchTourOperator $searchTourOperator,SearchMuseum $searchMuseum, MuseumRepository $museumRepository, TourOperatorRepository $tourOperatorRepository)
    {
        $allResults = [];
        $allResults[0] = [];
        $allResults[1] = [];

        $tourOperatorResults = $searchTourOperator->searchTourOperator($data, $tourOperatorRepository);
        $museumResults = $searchMuseum->searchTourOperator($data, $museumRepository);
//        $allResults[0] = $museumResults;
//        $allResults[1] = $tourOperatorResults;


        array_push($allResults[0], $museumResults);
        array_push($allResults[1], $tourOperatorResults);

        $serialize = $serializer->serialize($allResults);
        return $this->json($serialize);
    }
}
