<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/profile/{page}", name="profile", requirements={"page": "\d+"})
     */
    public function galleryList(EntityManagerInterface $entityManager, $page = 0)
    {
        $limit = 2;

        $galleryRepository = $entityManager->getRepository(Gallery::class);
        $galleryList = $galleryRepository->findGalleryByUserByPage($user = $this->getUser(), $page, $limit);

        $nbTotalSeries = count($galleryList);

        $nbPage = ceil($nbTotalSeries / $limit);

        return $this->render('user/profile.html.twig',
                compact('galleryList', 'page', 'nbPage')
        );
    }


    /**
     * @Route("/userProfile/{userId}/{page}", name="userProfile", requirements={"userId": "\d+", "page": "\d+"})
     */
    public function userProfile(EntityManagerInterface $entityManager, $userId, $page = 0)
    {
        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->find($userId);

        $limit = 2;

        $galleryRepository = $entityManager->getRepository(Gallery::class);
        $galleryList = $galleryRepository->findGalleryByUserByPage($user, $page, $limit);

        $nbTotalSeries = count($galleryList);

        $nbPage = ceil($nbTotalSeries / $limit);

        return $this->render('user/userProfile.html.twig',
                compact('galleryList', 'user', 'page', 'nbPage')
        );
    }


    /**
     * @Route("/user/index", name="index")
     */
    //@Route("/user", name="user")
    public function index()
    {
        return $this->render('user/index.html.twig', [
                'controller_name' => 'UserController',
        ]);
    }
}
