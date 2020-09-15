<?php
namespace App\frontend\controllers;

use App\library\BlogFram\Controller;

class FrontendController extends Controller
{

    public function displayHome()
    {
        $lastArticles = $this->articleManager->getLastArticles(4);
        echo $this->twig->render('frontend/home.twig', [
                                                        'page' => HOME, 
                                                        'articles' => $lastArticles,
                                                        ]);
    }

    public function displayArticles()
    {
        $articles = $this->articleManager->getAllArticles();
        echo $this->twig->render('frontend/all_posts.twig', [
                                                            'page' => POSTS, 
                                                            'articles' => $articles,
                                                            ]);
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
