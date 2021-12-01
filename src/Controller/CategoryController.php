<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{

    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/category", name="category.index")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $categories = $this->repository->findAll();
        $tabid = [];
        // dd($categories);
        foreach($categories as $categorie){
            $tabid[$categorie->getId()] = count($articleRepository->getArticlesByCategoryId($categorie->getId()));
        }

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories,
            'tabid' => $tabid
        ]);
    }

    /**
     * @Route("/category/{id}", name="category.show")
     */
    public function show(int $id, ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request) {
        $category = $this->repository->find($id);
        $articles = $paginator->paginate(
            $articleRepository->getArticlesByCategoryId($category->getId()),
            $request->query->getInt('page', 1),
            10
        );

        $nbid = count($articleRepository->getArticlesByCategoryId($category->getId()));
        if (!$category)
        {
            throw $this->createNotFoundException('The category does not exist');
        }else {
            return $this->render('category/show.html.twig', [
                'controller_name' => 'CategoryController',
                'category' => $category,
                'articles' => $articles,
                'nbid' => $nbid
            ]);
        }
        
    }
}
