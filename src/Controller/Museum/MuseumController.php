<?php

namespace App\Controller\Museum;

use App\Entity\Day;
use App\Entity\Museum;
use App\Repository\DayRepository;
use App\Repository\ScheduleRepository;
use App\Repository\TicketRepository;
use App\Service\FileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class MuseumController extends AbstractController
{
    private const  ImagePath = "images/museums/";
    /**
     * @Route("/museum", name="museum")
     */
    public function home(TicketRepository $ticketRepository, ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $museum = $this->getUser()->getMuseum();
        $museumId = $museum->getId();
        $date = new \DateTime();
        $date->format("D");
        $dayName = $date->format("l");
        $currentTime = $date->format('H');


        $dayId = $dayRepository->findOneBy(["name" => $dayName]);

        $schedule = null;
        $images = $museum->getImages();
        if ($dayId == null) {


        }
        $schedule = $scheduleRepository->findSchedulesOrdered($museumId, $dayId);

        $bestTickets = [];
        for ($i = 0; $i < count($schedule); $i++) {
            if ($schedule[$i]->getEndTime() > $currentTime) {

                $bestTickets = $ticketRepository->getBestMuseumTicketsOrdered($museumId, $currentTime);

            }
        }

        return $this->render('museum/home/index.html.twig', [
            'controller_name' => 'MuseumController',
            'images' => $images,
            'schedules' => $schedule,
            'dayName' => $dayName,
            'bestTickets' => $bestTickets,
            'userName' => $museum->getMuseumName(),
            'userImage' => self::ImagePath . $museum->getImage()
        ]);
    }

    /**
     * @Route("/museum/settings", name="museum_settings")
     */
    public function museumSettings(Request $request,FileService $fileService)
    {
        $museum = $this->getUser()->getMuseum();
        $images = $museum->getImages();

        $museumFormObj = new Museum();
        $form = $this->createFormBuilder($museumFormObj)
            ->add("image", FileType::class,array('data_class' => null, ))
            ->add("button", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $fileName = $fileService->MoveImage($form, true);
        if ($fileName != null){

            $newFileName = $fileService->MoveImage($form, true);

            if($newFileName != false) {
                $em = $this->getDoctrine()->getManager();
                $museum->setImage($newFileName);
                $em->persist($museum);
                $em->flush();

            }
        }
        }

        return $this->render('museum/settings/settings.html.twig', [
            'controller_name' => 'MuseumController',
            'images' => $images,
            'museum' => $museum,
            'form' => $form->createView(),
            'userName' => $museum->getMuseumName(),
            'userImage' => self::ImagePath . $museum->getImage()

        ]);
    }

    /**
     * @Route("/museum/schedule", name="museum_schedule")
     */
    public function schedule(ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $museum = $this->getUser()->getMuseum();
        $schedule = [];
        $days = $dayRepository->findAll();
        for ($i = 0; $i < count($days); $i++) {
            $daySchedule = [];

            array_push($daySchedule, $days[$i]);
            $scheduleForDay = $scheduleRepository->findSchedulesOrdered($museum, $days[$i]);
            array_push($daySchedule, $scheduleForDay);
            array_push($schedule, $daySchedule);


        }
        return $this->render('museum/schedule/schedule.html.twig', [
            'controller_name' => 'MuseumController',
            'schedules' => $schedule,
            'userName' => $museum->getMuseumName(),
            'userImage' => self::ImagePath . $museum->getImage()
        ]);
    }


    /**
     * @Route("/museum/stats", name="museum_stats")
     */
    public function stats(ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $museum = $this->getUser()->getMuseum();
        $reviews = $museum->getReviews();


        return $this->render('museum/stats/stats.html.twig', [
            'controller_name' => 'MuseumController',
            'reviews' => $reviews,
            'userName' => $museum->getMuseumName(),
            'userImage' => self::ImagePath . $museum->getImage()

        ]);
    }

    /**
     * @Route("/museum/tourists", name="museum_tourists")
     */
    public function tourists(ScheduleRepository $scheduleRepository, DayRepository $dayRepository)
    {
        $museum = $this->getUser()->getMuseum();
        $reviews = $museum->getReviews();


        return $this->render('museum/tourists/tourists.html.twig', [
            'controller_name' => 'MuseumController',
            'userName' => $museum->getMuseumName(),
            'userImage' => self::ImagePath . $museum->getImage()

        ]);
    }


//    public function SettingsView(\Symfony\Component\HttpFoundation\Request $request, FileService $fileService, PlayerService $playerService){
//        $currentPlayer = $this->getUser()->getPlayer();
//        $newPlayer = new Player();
//        $newPlayerStats = new PlayerStats();
//        $newUser = new User();
//        $playerStats = $currentPlayer->getStats();
//
//        $positions = $this->getDoctrine()->getRepository(Position::class)->findAll();
//
//        $formStats = $this->createForm(PlayerStatsType::class, $newPlayerStats);
//
//        $playerInfoForm = $this->createFormBuilder($newUser)
//            ->add('phone')
//            ->getForm();
//
//        $formPlayer = $this->createFormBuilder($newPlayer)
//            ->add('image', FileType::class, array('data_class' => null, ))
//            ->add('position')
//            ->getForm();
//
//        $formStats->handleRequest($request);
//        $formPlayer->handleRequest($request);
//        $playerInfoForm->handleRequest($request);
//
//        $fileName = $fileService->MoveImage($formPlayer);
//        if ($fileName != null){
//
//            $newFileName = $fileService->MoveImage($formPlayer);
//
//            if($newFileName != false) {
//                $em = $this->getDoctrine()->getManager();
//                $currentPlayer->setImage($newFileName);
//                $em->persist($currentPlayer);
//                $em->flush();
//
//            }
//        }
//
//
//        $playedMatches = $playerService->getPlayedMatches($currentPlayer);
//        $titularMatchers = $playerService->getTitularPlayedMatches($currentPlayer);
//        $playerGoals = $playerService->getGoals($currentPlayer);
//        $playedMinutes = $playerService->getTotalPlayedMinutes($currentPlayer);
//
//        return $this->render('player/settings/newSettingPage.html.twig',
//            array(
//
//                'playerForm' => $formPlayer->createView(),
//                'formStats' => $formStats->createView(),
//                'playerInfoForm' => $playerInfoForm->createView(),
//                "image" => $currentPlayer->getImage(),
//                'profile_img' =>$currentPlayer->getImage(),
//                'player' => $currentPlayer,
//                'form' => $formPlayer->createView(),
//                'team' => $this->playerPropService->getTeam($currentPlayer),
//                'playerStats' => $playerStats,
//                'playerName' => $currentPlayer->getUser()->getName(). ' '.$currentPlayer->getUser()->getFName(),
//                'goals' => $playerGoals,
//                'playedMinutes' => $playedMinutes,
//                'playedMatches' => $playedMatches,
//                'titularMatches' => $titularMatchers,
//            ));
//    } public function SettingsView(\Symfony\Component\HttpFoundation\Request $request, FileService $fileService, PlayerService $playerService){
//        $currentPlayer = $this->getUser()->getPlayer();
//        $newPlayer = new Player();
//        $newPlayerStats = new PlayerStats();
//        $newUser = new User();
//        $playerStats = $currentPlayer->getStats();
//
//        $positions = $this->getDoctrine()->getRepository(Position::class)->findAll();
//
//        $formStats = $this->createForm(PlayerStatsType::class, $newPlayerStats);
//
//        $playerInfoForm = $this->createFormBuilder($newUser)
//            ->add('phone')
//            ->getForm();
//
//        $formPlayer = $this->createFormBuilder($newPlayer)
//            ->add('image', FileType::class, array('data_class' => null, ))
//            ->add('position')
//            ->getForm();
//
//        $formStats->handleRequest($request);
//        $formPlayer->handleRequest($request);
//        $playerInfoForm->handleRequest($request);
//
//        $fileName = $fileService->MoveImage($formPlayer);
//        if ($fileName != null){
//
//            $newFileName = $fileService->MoveImage($formPlayer);
//
//            if($newFileName != false) {
//                $em = $this->getDoctrine()->getManager();
//                $currentPlayer->setImage($newFileName);
//                $em->persist($currentPlayer);
//                $em->flush();
//
//            }
//        }
//
//
//        $playedMatches = $playerService->getPlayedMatches($currentPlayer);
//        $titularMatchers = $playerService->getTitularPlayedMatches($currentPlayer);
//        $playerGoals = $playerService->getGoals($currentPlayer);
//        $playedMinutes = $playerService->getTotalPlayedMinutes($currentPlayer);
//
//        return $this->render('player/settings/newSettingPage.html.twig',
//            array(
//
//                'playerForm' => $formPlayer->createView(),
//                'formStats' => $formStats->createView(),
//                'playerInfoForm' => $playerInfoForm->createView(),
//                "image" => $currentPlayer->getImage(),
//                'profile_img' =>$currentPlayer->getImage(),
//                'player' => $currentPlayer,
//                'form' => $formPlayer->createView(),
//                'team' => $this->playerPropService->getTeam($currentPlayer),
//                'playerStats' => $playerStats,
//                'playerName' => $currentPlayer->getUser()->getName(). ' '.$currentPlayer->getUser()->getFName(),
//                'goals' => $playerGoals,
//                'playedMinutes' => $playedMinutes,
//                'playedMatches' => $playedMatches,
//                'titularMatches' => $titularMatchers,
//            ));
//    }



}