<?php

namespace App\Controller\Admin;

use App\Entity\Museum;
use App\Entity\Role;
use App\Entity\User;
use App\Repository\CityRepository;
use App\Repository\RoleRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class AdminPostController extends AbstractController
{
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
            $user->setPassword($password);

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
}
