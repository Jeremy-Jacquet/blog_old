<?php
namespace App\library\BlogFram;

use App\library\Model\UserManager;
use App\library\Model\ArticleManager;
use App\library\Model\CategoryManager;
use App\library\Model\CommentManager;
use App\library\Model\AuthorManager;
use App\library\BlogFram\Security;

class Controller 
{
    use Security;

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
        $this->twig = ($twig = new Twig())->getTwig();
    }

    public function displayLogout()
    {
        setcookie(COOKIE_PROTECT, "", time() - 3600);
        $_SESSION[COOKIE_PROTECT] ="";
        session_unset();
        session_destroy();
        $this->redirect(HOME);
    }

    public function redirect($url, $replace = true, $statusCode = 303)
    {
        header('Location: ' . URL . $url, $replace, $statusCode);
        exit();
    }

    public function redirectAccess()
    {
        if($this->isSESSION(['access'])) {
            if($_SESSION['access'] == (ADMIN_ACCESS OR AUTHOR_ACCESS)) {
                $this->redirect(ADMIN);
            } elseif($_SESSION['access'] == USER_ACCESS) {
                $this->redirect(HOME);
            } else {
                $this->displayLogout();
            }
        } else {
            $this->redirect(HOME);
        }
    }

    protected function displayError($message)
    {
        header("HTTP/1.0 404 Not Found");
        echo $this->twig->render('frontend/error.twig', ['page' => ERROR, 'message' => $message]);
    }

}
