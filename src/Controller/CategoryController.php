<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/creer-categorie", name="create_category", methods={"GET|POST"} )
     * @param Request $request
     * @param SluggerInterface $slugger
     * @param EntityManagerInterface $entityManager
     */
    public function createCategory(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category)->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $category->setAlias($slugger->slug($category->getName()));

            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'La catégorie est bien créée');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/form_category.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
