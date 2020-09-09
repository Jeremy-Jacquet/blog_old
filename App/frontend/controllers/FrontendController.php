<?php
namespace App\frontend\controllers;

use App\library\BlogFram\Controller;

class FrontendController extends Controller
{

    public function displayHome()
    {
    }

    public function displayArticles()
    {
        $articles = $this->articleManager->getAllArticles();
    }

    public function displayCategories()
    {
        $categories = $this->categoryManager->getAllCategories();
    }

    public function displayError()
    {
    }

}
