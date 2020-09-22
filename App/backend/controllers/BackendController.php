<?php
namespace App\backend\controllers;

use App\library\BlogFram\Controller;
use App\library\BlogFram\Image;
use App\library\BlogFram\Utilities;
use App\library\Entity\User;
use App\library\Entity\Article;

class BackendController extends Controller
{
    use Utilities;
    use Image;
    
    public function displayLogin($module)
    {
        if($this->isConnected()) {
            $this->redirectAccess();

        } elseif($this->isFormValid($module)) {
            $pseudo = $this->secure($_POST['pseudo']);
            $pass = $this->secure($_POST['pass']);
            if($this->userManager->existsUser($pseudo, $pass)){
                $user = $this->userManager->getUserByPseudo($pseudo);
                $this->setSessionAccess($user);
                $this->generateCookie();
                $this->redirectAccess();
            }
        } else {
            $this->redirect(LOGIN);
        } 
    }

    public function displayAdminDashboard()
    {
        echo $this->twig->render('backend/dashboard.twig', ['page' => ADMIN]);
    }
    
    public function displayRegister()
    {
    }

    public function displayAdminArticles($module, $action = null, $id = null) {
        if($this->isAdmin()) {
            if(is_null($action)) {
                $articles = $this->articleManager->getAllArticles();
                echo $this->twig->render('backend/dashboard.twig', ['page' => ADMIN, 'articles' => $articles]);
            } else if($action == ADD) {
                if($this->isFormValid($module, $action)) {
                    $article = new Article($this->secureArray($this->getPostToArray()));
                    $imagePath = $this->uploadImage($_FILES['fileUpload'], TARGET_DIR_BLOG, NAME_IMAGE_BLOG);
                    $this->articleManager->addArticle($article, $imagePath);
                    $this->redirectAccess();
                } else {
                    echo $this->twig->render('backend/addArticle.twig');
                }
            } else if($action == UP) {
                if($this->isFormValid($module, $action)) {
                    $id = $_POST['id'];
                    unset($_POST['id']);

                    if($_FILES['fileUpload']) {
                        $attribute = 'imagePath';
                        $value = $this->uploadImage($_FILES['fileUpload'], TARGET_DIR_BLOG, NAME_IMAGE_BLOG);
                    } else {
                        $attribute = $this->getPostToAttribute();
                        $value = $this->getPostToValue();
                    }
                    $this->articleManager->updateArticle($id, $attribute, $value);
                    $this->redirectAccess();

                } else {
                    $article = $this->articleManager->getArticle($id);
                    echo $this->twig->render('backend/upArticle.twig', ['page' => ADMIN, 'articles' => $article]);
                }

            } else if($action == DEL) {
                $this->articleManager->deleteArticle($id);
                $this->redirectAccess();
            }
        }     
    }

    public function displayAdminComments()
    {
    }

    public function displayAdminCategories()
    {
    }

    public function displayAdminAuthors()
    {
    }

    public function displayAdminUsers()
    {
    }

}
