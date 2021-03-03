<?php

namespace App\Controller;

use App\Repository\DayRepository;
use App\Repository\MuseumRepository;
use App\Repository\MuseumReviewsRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use App\Repository\TourOperatorRepository;
use App\Service\tourOperatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GeneralController extends AbstractController
{
    const TourOperatorImagePath = "images/tourOperator/";
    const MuseumImagePath = "images/museums/";
    const AdminImage = 'images/leader-image.jpg';
    const AdminUserName = 'The Leader';

    /**
     * @Route("/general/tourOperator/{profileId}", name="tourOperatorProfile")
     */
    public function tourOperatorProfile($profileId, TourOperatorRepository $tourOperatorRepository,TicketRepository $ticketRepository,  tourOperatorService $tourOperatorService)
    {
        $credentials = $this->getUserCredentials();
        $userImage = $credentials[0];
        $userName = $credentials[1];

        $tourOperatorFriend = $tourOperatorRepository->find($profileId);
        $bestReview = $tourOperatorService->getBestReview($tourOperatorFriend->getId(), $tourOperatorRepository);
        $tickets = $tourOperatorService->getTickets($profileId, $ticketRepository);

        $visitedMuseums = $tourOperatorService->getVisitedMuseums($profileId, $ticketRepository, $tourOperatorRepository);
        return $this->render('general/tourOperatorProfile.html.twig', [
            'controller_name' => 'TourOperatorController',
            'userName' => $userName,
            'userImage' => $userImage,
            'friend' => $tourOperatorFriend,
            'friendImage' => self::TourOperatorImagePath.$tourOperatorFriend->getImage(),
            'bestReview' => $bestReview,
            'tickets' => $tickets,
            'visitedMuseums' => $visitedMuseums

        ]);

    }

    /**
     * @Route("/general/museumsProfile/{id}", name="museumProfile")
     */
    public function museusmProfile($id,MuseumReviewsRepository  $museumReviewsRepository, TicketRepository  $ticketRepository, MuseumRepository $museumRepository,DayRepository $dayRepository, ScheduleRepository $scheduleRepository)
    {
        $credentials = $this->getUserCredentials();
        $userImage = $credentials[0];
        $userName = $credentials[1];

        $museum = $museumRepository->find(intval($id));

        $date = new \DateTime();
        $dayName = $date->format("l");

        $dayId = $dayRepository->findOneBy(["name" => $dayName]);

        $schedule = null;
        if ($dayId != null) {
            $schedule = $scheduleRepository->findSchedulesOrdered($id, $dayId);
        }

        $tickets = null;
        if ($this->isGranted('ROLE_TOUROPERATOR')){
            $tourOperator = $this->getUser()->getTourOperator();
            $tickets = $ticketRepository->getTourOperatorTicketsOrdered($tourOperator->getId(), $id);

        }
        $museumReviews = $museumReviewsRepository->findBy(['id' => $id],array(), 4);

        return $this->render('general/museumProfile.html.twig', [
            'controller_name' => 'TourOperatorController',
            'museum' => $museum,
            'schedules' => $schedule,
            'tickets' => $tickets,
            'userName' => $userName,
            'userImage' =>  $userImage,
            'museumReviews' => $museumReviews
        ]);
    }

    private function getUserCredentials(){
        $userImage = self::AdminImage;
        $userName = self::AdminUserName;

        if ($this->isGranted('ROLE_TOUROPERATOR')) {
            $tourOperator =  $this->getUser()->getTourOperator();
            $userImage = self::TourOperatorImagePath.$tourOperator->getImage();
            $userName = $tourOperator->getName() .' '. $tourOperator->getFName();

        }else if ($this->isGranted('ROLE_MUSEUM')){
            $museum = $this->getUser()->getMuseum();
            $userImage =self::MuseumImagePath.$museum->getImage();
            $userName = $museum->getMuseumName();

        }
        return $credentials = [$userImage, $userName];
    }

}
