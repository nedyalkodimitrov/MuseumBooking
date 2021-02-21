<?php

namespace App\Controller\Admin;

use App\Entity\Museum;
use App\Entity\Role;
use App\Entity\TourOperator;
use App\Entity\User;
use App\Repository\CityRepository;
use App\Repository\RoleRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class AdminPostController extends AbstractController
{
    const  options = [
                'cost' => 12,
            ];
    /**
     * @Route("/admin/createMuseumAction", name="admin_create_museum", methods={"POST"})
     */
    public function createMuseumAction( \Symfony\Component\HttpFoundation\Request $request, RoleRepository $roleRepository, CityRepository $cityRepository)
    {

        $em = $this->getDoctrine()->getManager();
        $museumName = $request->request->get('name');
        $maxCapacity = $request->request->get('maxCapacity');
        $city = $request->request->get('city');

        $email = $request->request->get('email');
        $password = $request->request->get('password');


        $role = $roleRepository->find(2);
        $city = $cityRepository->find(intval($city));

        try {
            $user = new User();
            $museum = new Museum();
            $user->setEmail($email);
            $user->setPassword( password_hash($password, PASSWORD_BCRYPT, self::options));

            $em->persist($user);

            $museum->setCity($city);
            $museum->setMuseumName($museumName);
            $museum->setUser($user);
            $museum->setMaxCapacity($maxCapacity);
            $museum->setRating(0);
            $museum->setAdditionalInformation('');
            $museum->setImage('museum-no-photo.jpg');
            $em->persist($museum);

            $user->setMuseum($museum);
            $user->setRoles([$role]);
            $em->persist($user);

            $em->flush();
        }catch (\Exception $exception){

            return $this->json($request->request->get('email'));
        }

        return $this->json('1');
    }


    /**
     * @Route("/admin/createTourOperatorAction", name="admin_create_tourOperator", methods={"POST"})
     */
    public function creatTourOperator( \Symfony\Component\HttpFoundation\Request $request, RoleRepository $roleRepository, CityRepository $cityRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $name = $request->request->get('name');
        $fName = $request->request->get('fName');
        $phoneNumber = $request->request->get('phoneNumber');
        $city = $request->request->get('city');

        $email = $request->request->get('email');
        $password = $request->request->get('password');


        $role = $roleRepository->find(1);
        $city = $cityRepository->find(intval($city));

        try {
            $user = new User();
            $tourOperator = new TourOperator();

            $user->setEmail($email);
            $user->setPassword( password_hash($password, PASSWORD_BCRYPT, self::options));

            $em->persist($user);

            $tourOperator->setName($name);
            $tourOperator->setFName($fName);
            $tourOperator->setPhoneNumber($phoneNumber);
            $tourOperator->setVisitRating(0);
            $tourOperator->setCity($city);

            $tourOperator->setUser($user);

            $tourOperator->setImage('user-no-photo.jpg');

            $em->persist($tourOperator);

            $user->setTourOperator($tourOperator);
            $user->setRoles([$role]);

            $em->persist($user);

            $em->flush();
        }catch (\Exception $exception){

            return $this->json($exception->getMessage());
        }

        return $this->json('1');
    }

}
