<?php

namespace App\Controller;

use App\Entity\Gallery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends Controller
{
    /**
     * @Route("/{page}", name="home", requirements={"page": "\d+"})
     */
    public function index(EntityManagerInterface $entityManager, $page = 0)
    {

        $limit = 2;

        $galleryRepository = $entityManager->getRepository(Gallery::class);
        $galleryListAll = $galleryRepository->findGalleryByPage($page, $limit);

        $nbTotalSeries = count($galleryListAll);

        $nbPage = ceil($nbTotalSeries / $limit);

        return $this->render('main/index.html.twig',
                compact('galleryListAll', 'page', 'nbPage')
        );
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('main/login.html.twig', [
                'last_username' => $lastUsername,
                'error'         => $error,
        ]);
    }
}
