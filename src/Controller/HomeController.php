<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $repoArticle;

    public function __construct(ArticleRepository $repoArticle){
        $this->repoArticle = $repoArticle;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(CategoryRepository $repoCategory): Response
    {
        $articles = $this->repoArticle->findAll();
        $categories = $repoCategory->findAll();

        return $this->render("home/index.html.twig", [
            'articles' => $articles,
            'categories' => $categories
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
    public function view(Article $article): Response
    {
        if(!$article)
            return $this->redirectToRoute('home');
        return $this->render("home/view.html.twig",[
            'article'=>$article
        ]);
    }

    /**
     * @Route("/showByCategory/{id}", name="showByCategory")
     */
    public function showByCategory(Category $category): Response
    {
        if(!$category)
            return $this->redirectToRoute('home');
        return $this->render("home/index.html.twig",[
            'articles'=>$category->getArticles(),
        ]);
    }


}

