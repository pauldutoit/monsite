<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {   
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll(); 
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);
    }

     /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('article/home.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

     /**
     * @Route("/create", name="create_article")
     */
    public function create()
    {
        return $this->render('article/create.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
}
