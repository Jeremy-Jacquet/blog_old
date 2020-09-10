<?php
namespace App\frontend\controllers;

use App\library\BlogFram\Controller;

class FrontendController extends Controller
{

    public function displayHome()
    {
        $pageTitle = "Accueil";
        $title = [1 => 'Presentation', 2 => 'Derniers articles'];
        $lastArticles = $this->articleManager->getLastArticles(4);
        echo $this->twig->render('frontend/home.twig', ['pageTitle' => $pageTitle,'title' => $title, 'articles' => $lastArticles]);
    }

    public function displayArticles()
    {
        echo 'Je suis la page des articles';
        $articles = $this->articleManager->getAllArticles();
    }

    public function displayCategories()
    {
        echo 'Je suis la page des catégories';
        $categories = $this->categoryManager->getAllCategories();
    }

    public function displayError()
    {
        header('HTTP/1.0 404 Not Found');
        echo $this->twig->render('404.twig');
    }

}
