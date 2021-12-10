<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    // public function index(ArticleRepository $articleRepository)
    // public function index(ArticleRepository $articleRepository, PaginatorInterface $paginator)
    public function index(ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $paginator->paginate(
            $articleRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);


    }

    /**
     * @Route("/article/new", name="article.create")
     */
    public function create(Request $request): Response
    {

        $article = new Article();

        $articleForm = $this->createForm(ArticleType::class, $article);

        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid())
        {
            $article->setCreatedAt(new \DateTime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article.show', [
                'id' => $article->getId()
            ]);
        }

        return $this->render('article/create.html.twig', [
            'articleForm' => $articleForm->createView() 
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


    /**
     * @Route("/article/{id}/edit", name="article.edit")
     */
    public function show(int $id, ArticleRepository $articleRepository) {

    }

    
}
