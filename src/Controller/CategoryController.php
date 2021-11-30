<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category.index")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/{id}", name="category.show")
     */
    public function show(int $id, CategoryRepository $categoryRepository) {
        $categorie = $categoryRepository->find($id);
        if (!$categorie)
        {
            throw $this->createNotFoundException('The categorie does not exist');
        }else {
            return $this->render('categorie/show.html.twig', [
                'controller_name' => 'CategoryController',
                'categorie' => $categorie
            ]);
        }
        
    }
}
