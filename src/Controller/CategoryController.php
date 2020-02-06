<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/admin/category", name="addCategory")
     */
    public function createCategory(Request $request): Response
    {
        $category = new Category();
        $catForm = $this->createForm(CategoryType::class, $category);
        $catForm->handleRequest($request);

        if ($catForm->isSubmitted() && $catForm->isValid()) {

            $this->addFlash(
                    'success',
                    'Catégorie ajoutée!'
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('addCategory');
        }

        return $this->render('category/register.html.twig', [
                'catForm' => $catForm->createView(),
        ]);
    }
}
