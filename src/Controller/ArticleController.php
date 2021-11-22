<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);


    }

    /**
     * @Route("/article/{id}", name="article.show")
     */
    public function show(int $id, ArticleRepository $articleRepository) {
        $article = $articleRepository->find($id);
        if (!$article)
        {
            throw $this->createNotFoundException('The article does not exist');
        }else {
            return $this->render('article/show.html.twig', [
                'controller_name' => 'ArticleController',
                'article' => $article
            ]);
        }
        
    }
}
