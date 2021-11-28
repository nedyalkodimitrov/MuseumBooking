<?php

namespace App\Controller\TourOperator;

use App\Entity\TourOperator;
use App\Entity\Trip;
use App\Repository\TourOperatorRepository;
use App\Repository\TripRepository;
use App\Security\TripCRUD;
use App\Service\UserNameService;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Couchbase\basicEncoderV1;
use function PHPUnit\Framework\throwException;

class TripController extends BaseController
{

    /**
     * @Route("/tourOperator/trips", name="tour_operator_show_trips")
     */
    public function allTripsView(TripRepository $tripRepository)
    {
        $tourOperator = $this->getUser()->getTourOperator();
        $images = array();
        $trips = $tourOperator->getTrips();
        foreach ($trips as $key => $trip) {
            $images[$key] = base64_encode(stream_get_contents($trip->getImage()));
        }

        //        $trips = $tripRepository->findAll();
        $params = [
            'trips' => $trips,
            'images' => $images
        ];



       return $this->customRenderView('tour_operator/trip/allTrips.html.twig', $params);
    }


    /**
     * @Route("/tourOperator/trip/{id}", name="tour_operator_show_single_trip")
     */
    public function tripView($id, TripRepository $tripRepository)
    {

        $trip = $tripRepository->find($id);
        $image = base64_encode(stream_get_contents($trip->getImage()));
        $params = [
            'trip' => $trip,
            'image' => $image

        ];

        return $this->customRenderView('tour_operator/trip/trip.html.twig', $params);
    }





    /**
     * @Route("/tourOperator/trip/{id}/friend", name="tour_operator_add_friend")
     */
    public function addFriend($id,\Symfony\Component\HttpFoundation\Request $request, TripRepository $tripRepository, TourOperatorRepository $tourOperatorRepository, TripCRUD $tripCRUD)
    {
        $em = $this->getDoctrine()->getManager();
//        $tourOperatorId = $request->request->get('tourOperatorId');
        $tourOperatorId = 14;

        $trip = $tripRepository->find((int)$id);
        $friend = $tourOperatorRepository->find((int)$tourOperatorId);

        if ($friend == null){
            throwException("No such user");
        }

        $friends = $tripCRUD->addFriendTo($friend, $trip);
        $trip->setFriends($friends);
        $em->persist($trip);
        $em->flush();

        return $this->json(1);

    }



    /**
     * @Route("/tourOperator/trip/{id}/friend", name="tour_operator_remove_friend", methods={"DELETE"})
     */
    public function removeFriend($id, \Symfony\Component\HttpFoundation\Request $request, TripRepository $tripRepository, TourOperatorRepository $tourOperatorRepository, TripCRUD $tripCRUD)
    {
        $em = $this->getDoctrine()->getManager();
        $tourOperatorId = $request->request->get('tourOperatorId');

        $trip = $tripRepository->find((int)$id);
        $friend = $tourOperatorRepository->find((int)$tourOperatorId);

        if ($friend == null){
            throwException("No such user");
        }

        $friends = $tripCRUD->removeFriendFrom($friend, $trip);

        $trip->setFriends($friends);
        $em->persist($trip);
        $em->flush();

        return $this->json(1);

    }

    /**
     * @Route("/tourOperator/trip/searchLandMark/{landmarkName}", name="tour_operator_remove_friend", methods={"DELETE"})
     */
    public function searchLandMarks($landmarkName, \Symfony\Component\HttpFoundation\Request $request, TripRepository $tripRepository, TourOperatorRepository $tourOperatorRepository, TripCRUD $tripCRUD)
    {
        $em = $this->getDoctrine()->getManager();
        $tourOperatorId = $request->request->get('tourOperatorId');

        $trip = $tripRepository->find((int)$id);
        $friend = $tourOperatorRepository->find((int)$tourOperatorId);

        if ($friend == null){
            throwException("No such user");
        }

        $friends = $tripCRUD->removeFriendFrom($friend, $trip);

        $trip->setFriends($friends);
        $em->persist($trip);
        $em->flush();

        return $this->json(1);

    }







}
