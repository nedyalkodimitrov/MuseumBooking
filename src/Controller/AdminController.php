<?php

namespace App\Controller;

use App\Entity\Museum;
use App\Entity\TourOperator;
use App\Entity\User;
use App\Form\MuseumType;
use App\Form\TourOperatorType;
use App\Form\UserType;
use App\Repository\MuseumRepository;
use App\Repository\TourOperatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
const leaderImage = 'images/leader-image.jpg';
    /**
     * @Route("/admin", name="adminHome")
     */
    public function index(MuseumRepository $museumRepository, TourOperatorRepository  $tourOperatorRepository)
    {
        $museums = $museumRepository->findLastAdded();
        $tourOperators = $tourOperatorRepository->findLastAdded();
        $topMuseums = $museumRepository->getTopMuseums();
        return $this->render('admin/home/home.html.twig', [
            'controller_name' => 'AdminController',
            'userName' => 'The Leader',
            'userImage' => self::leaderImage,
            'lastAddedMuseums' => $museums,
            'lastAddedTourOperators' => $tourOperators,
            'topMuseums' => $topMuseums
        ]);
    } /**
 * @Route("/admin/createMuseum", name="createMuseum")
 */
    public function createMuseumView(MuseumType $museumType, UserType $userType)
    {
        $museum = new Museum();
        $user = new User();

        $museumForm = $this->createForm(MuseumType::class, $museum);
        $userForm = $this->createForm(UserType::class, $user);

        return $this->render('admin/museum/createMuseum.html.twig', [
            'controller_name' => 'AdminController',
            'userName' => 'The Leader',
            'userImage' => self::leaderImage,
            'museumForm' => $museumForm->createView(),
            'userForm' => $userForm->createView(),

        ]);
    } /**
 * @Route("/admin/createTourOperator", name="createTourOperator")
 */
    public function createTourOperatorView()
    {

        $tourOperator = new TourOperator();
        $user = new User();

        $tourOperatorForm = $this->createForm(TourOperatorType::class, $tourOperator);
        $userForm = $this->createForm(UserType::class, $user);

        return $this->render('admin/tourOperator/createTourOperator.html.twig', [
            'controller_name' => 'AdminController',
            'userName' => 'The Leader',
            'userImage' => self::leaderImage,
            'userForm' => $userForm->createView(),
            'tourOperatorForm' => $tourOperatorForm->createView(),
        ]);
    }
}
