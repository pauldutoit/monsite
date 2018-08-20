<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

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
     * @Route("/article/new", name="create_article")
     * @Route("/article/{id}/edit", name="edit_article")
     */
    public function form(Article $article = null, Request $request, ObjectManager $manager)
    {
        //$article = new Article();

        if(!$article){
            $article = new Article();
        }

        $form = $this->createFormBuilder($article)
            ->add('title')
            ->add('content')
            ->add('image')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!$article->getId()){
            $article->setCreatedAt(new \DateTime());
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        }


        return $this->render('article/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show($id)
    {   
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);
        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }

     /**
     * @Route("/about", name="about")
     */
    public function about()
    {   
        return $this->render('article/about.html.twig');
    }

      /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request)
    {   

        $user = new User();
       // $repo = $this->getDoctrine()->getRepository(User::class);

        $formUser = $this->createFormBuilder($user)
            ->add('email')
            ->add('password')
            ->getForm();

        // $form->handleRequest($request);

        // if($form->isSubmitted() && $form->isValid()){


        //     $manager->persist($article);
        //     $manager->flush();

        //     return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        // }


        return $this->render('article/connexion.html.twig',[
            'formUser' => $formUser->createView()
        ]);
    }
}
