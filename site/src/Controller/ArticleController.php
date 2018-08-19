<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
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
