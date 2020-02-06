<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\GalleryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery", name="gallery")
     */
    public function index()
    {
        return $this->render('gallery/index.html.twig', [
                'controller_name' => 'GalleryController',
        ]);
    }

    /**
     * @Route("/newPiece", name="newPiece")
     */
    public function addNewPiece(Request $request): Response
    {
        $newPiece = new Gallery();
        $newPiece->setUser($this->getUser());

        $pieceForm = $this->createForm(GalleryType::class, $newPiece);
        $pieceForm->handleRequest($request);

        if ($pieceForm->isSubmitted() && $pieceForm->isValid()) {

            $this->addFlash(
                    'success',
                    'Une nouvelle pièce a été ajoutée à votre galerie!'
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newPiece);
            $entityManager->flush();

            return $this->redirectToRoute('newPiece');
        }

        return $this->render('gallery/register.html.twig', [
                'pieceForm' => $pieceForm->createView(),
        ]);
    }
}
