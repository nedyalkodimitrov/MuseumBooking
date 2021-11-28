<?php

namespace App\Security;

use App\Entity\Landmark;
use App\Entity\Museum;
use App\Entity\TourOperator;
use App\Entity\Trip;
use App\Repository\TourOperatorRepository;
use Symfony\Component\Translation\Reader\TranslationReaderInterface;
use Doctrine\ORM\EntityManagerInterface;
class TripCRUD
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addFriendTo(TourOperator $friend, Trip $trip){
        $friends = $this->getExistingFriends($trip);
        $friends[] = $friend;

        return $friends;
    }


    public function removeFriendFrom(TourOperator $removedFriend, Trip $trip){
        $associativeFriends = $trip->getFriends();
        $friends = [];

        foreach ($associativeFriends as $friend){
            if ($friend->getid() == $removedFriend->getId()){
                continue;
            }
            $friends[] = $friend;
        }
        return $friends;
    }


    public function addMuseumTo(Museum $museum, Trip $trip){
        $museums = $this->getExistingFriends($trip);
        $museums[] = $museum;

        return $museums;
    }


    public function removeMusuemFrom(Museum $removedMuseum, Trip $trip){
        $associativeMuseums = $trip->getMuseums();
        $museums = [];

        foreach ($associativeMuseums as $museum){
            if ($museum->getid() == $removedMuseum->getId()){
                continue;
            }
            $museums[] = $museum;
        }
        return $museums;
    }

    public function addLandmarkTo(Landmark $landmark, Trip $trip){
        $landmarks = $this->getExistingLandmarks($trip);
        $landmarks[] = $landmark;

        return $landmarks;
    }


    public function removeLandmarkmFrom(Landmark $removedLandmark, Trip $trip){
        $associativeLandmark = $trip->getLandmarks();
        $landmarks = [];

        foreach ($associativeLandmark as $landmark){
            if ($landmark->getid() == $removedLandmark->getId()){
                continue;
            }
            $landmarks[] = $landmark;
        }
        return $landmarks;
    }





    private function getExistingFriends(Trip $trip){
        $associativeFriends = $trip->getFriends();
        $friends = [];

        foreach ($associativeFriends as $friend){
            $friends[] =  $friend;
        }

        return $friends;
    }

    private function getExistingMuseums(Trip $trip){
        $associativeMuseums = $trip->getMuseums();
        $museums = [];

        foreach ($associativeMuseums as $museum){
            $museums[] =  $museum;
        }
        return $museums;
    }

    private function getExistingLandmarks(Trip $trip){
        $associativeLandmarks = $trip->getLandmarks();
        $landmarks = [];

        foreach ($associativeLandmarks as $landmark){
            $landmarks[] =  $landmark;
        }
        return $landmarks;
    }

}