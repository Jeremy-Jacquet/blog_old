<?php
namespace App\library\BlogFram;

use App\library\Model\UserManager;
use App\library\Model\ArticleManager;
use App\library\Model\CategoryManager;
use App\library\Model\CommentManager;
use App\library\Model\AuthorManager;

class Controller 
{
    protected $userManager;
    protected $articleManager;
    protected $categoryManager;
    protected $commentManager;
    protected $authorManager;
    protected $twig;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->articleManager = new ArticleManager();
        $this->categoryManager = new CategoryManager();
        $this->commentManager = new CommentManager();
        $this->authorManager = new AuthorManager();
        $this->setTwig();
    }

    private function setTwig()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false, //__DIR__ . '../../../public/tmp'
        ]);
    }
}
