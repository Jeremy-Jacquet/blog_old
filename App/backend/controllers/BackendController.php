<?php
namespace App\backend\controllers;

use App\library\BlogFram\Controller;
use App\library\BlogFram\Image;
use App\library\BlogFram\Utility;
use App\library\BlogFram\Translate;
use App\library\Entity\User;
use App\library\Entity\Article;
use App\library\Entity\Author;
use App\library\Entity\Category;
use App\library\Entity\Comment;

class BackendController extends Controller
{
    use Utility;
    use Image;
    use Translate;
    
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
            }
            $this->redirectAccess();
        }
    }

    public function displayRegister()
    {
    }

    public function displayAdminAdd($module, $action, $id = null) 
    {
        //if($this->isAdmin()) {
            if($this->isFormValid($module, $action)) {
                $this->adminAdd($module);
                $this->redirectAccess();
            } else {
                $entity = ucfirst(substr($this->translate($module), 0, -1));
                echo $this->twig->render('backend/add' .$entity. '.twig', ['page' => ADMIN]);
            }
        //}
    }

    public function displayAdminUpdate($module, $action, $id) 
    {
        //if($this->isAdmin()) {
            if($this->isFormValid($module, $action)) {
                $this->adminUpdate($module);
            }
            $entity = substr($this->translate($module), 0, -1);
            $entityManager = $entity.'Manager';
            $getEntity = 'get'.ucfirst($entity);
            $entityObj = $this->$entityManager->$getEntity($id);
            echo $this->twig->render('backend/update' .ucfirst($entity). '.twig', ['page' => ADMIN, 'entity' => $entityObj]);
        //}
    }

    public function displayAdminDelete($module, $action, $id)
    {
        //if($this->isAdmin()) {
            $entity = substr($this->translate($module), 0, -1);
            $entityManager = $entity.'Manager';
            $deleteEntity = 'delete'.ucfirst($entity);
            $this->$entityManager->$deleteEntity($id);
            $this->redirectAccess();
        //}
    }

    public function displayAdminModule($module, $action = null, $id = null)
    {
        //if($this->isAdmin()) {  
            if($module == DASHBOARD) {
                echo $this->twig->render('backend/dashboard.twig', ['page' => ADMIN]);
            } else {
                $module = $this->translate($module);
                $entityManager = substr($module, 0, -1).'Manager';
                $getAllEntities = 'getAll'.ucfirst($module);
                $entities = $this->$entityManager->$getAllEntities();

                echo $this->twig->render('backend/admin'.ucfirst($module).'.twig', ['page' => ADMIN, 'entities' => $entities]);
            }
        //}
    }

    public function adminAdd($module)
    {
        $entity = substr($this->translate($module), 0, -1);
        $Entity = ucfirst($entity);
        $entityManager = $entity.'Manager';
        $addEntity = 'add'.ucfirst($entity);
        $entity = new $Entity($this->secureArray($this->getPostToArray()));

        
        if($module == COMMENTS) {
            $this->$entityManager->$addEntity($entity);
        } else {
            if($module == (POSTS OR CATEGORIES)) {
                $imagePath = $this->uploadImage($_FILES['fileUpload'], TARGET_IMAGE_BLOG, NAME_IMAGE_BLOG);
            } elseif($module == (AUTHORS OR USERS)) {
                $imagePath = $this->uploadImage($_FILES['fileUpload'], TARGET_IMAGE_AVATAR, NAME_IMAGE_AVATAR);
            }
            $this->$entityManager->$addEntity($entity, $imagePath);
        }
    }

    public function adminUpdate($module) 
    {    
        $id = $_POST['id'];
        unset($_POST['id']);
        if(isset($_FILES['fileUpload'])) {
            $attribute = 'imagePath';
            $value = $this->uploadImage($_FILES['fileUpload'], TARGET_IMAGE_BLOG, NAME_IMAGE_BLOG);
        } else {
            $attribute = $this->getPostToAttribute();
            $value = $this->getPostToValue();
        }
        $entity = substr($this->translate($module), 0, -1);
        $entityManager = $entity.'Manager';
        $updateEntity = 'update'.ucfirst($entity);

        $this->$entityManager->$updateEntity($id, $attribute, $value);
    }

}
