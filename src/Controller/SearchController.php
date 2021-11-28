<?php

namespace App\Controller;

use App\Repository\LandmarkRepository;
use App\Repository\MuseumRepository;
use App\Repository\TourOperatorRepository;
use App\Service\CustomSerializer;
use App\Service\SearchLandmark;
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

        $tourOperatorResults = $searchTourOperator->find($data, $tourOperatorRepository);
        $museumResults = $searchMuseum->find($data, $museumRepository);

        $allResults[0] =  $museumResults;
        $allResults[1] = $tourOperatorResults;

        $serialize = $serializer->serialize($allResults);
        return $this->json($serialize);
    }




    /**
     * @Route("/searchLandmark/{landmarkInfo}", name="search_landmark")
     */
    public function searchLandmark($landmarkInfo, CustomSerializer $serializer, SearchLandmark $searchLandmark, LandmarkRepository $landmarkRepository)
    {
        $searchResults = $searchLandmark->find($landmarkInfo, $landmarkRepository);

        return $this->json($serializer->serialize($searchResults));

    }

    /**
     * @Route("/searchMuseum/{museumInfo}", name="search_museum")
     */
    public function searchMuseum($museumInfo, CustomSerializer $serializer, SearchMuseum $searchMuseum, MuseumRepository $museumRepository)
    {
        $searchResults = $searchMuseum->find($museumInfo, $museumRepository);

        return $this->json($serializer->serialize($searchResults));

    }
    /**
     * @Route("/searchTourOperator/{tourOperatorInfo}", name="search_tour_operator")
     */
    public function searchTourOperator($tourOperatorInfo, CustomSerializer $serializer, SearchTourOperator $searchTourOperator, TourOperatorRepository $tourOperatorRepository)
    {
        $searchResults = $searchTourOperator->find($tourOperatorInfo, $tourOperatorRepository);

        return $this->json($serializer->serialize($searchResults));

    }
}
