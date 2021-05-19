<?php

namespace App\Controller;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll();

        return $this->render("home/index.html.twig", [
            'articles' => $articles
        ]);
    }

        /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render("home/about.html.twig");
    }

    /**
     * @Route("/view/{id}", name="view")
     */
    public function view($id): Response
    {

        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);
        if(!$article)
            return $this->redirectToRoute('home');
        return $this->render("home/view.html.twig",['article'=>$article]);
    }
}

