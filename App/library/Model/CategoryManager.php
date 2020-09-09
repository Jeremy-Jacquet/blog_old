<?php
namespace App\library\Model;

use App\library\BlogFram\Database;
use App\library\BlogFram\Manager;
use App\library\Entity\Category;
use \PDO;

class CategoryManager extends Manager
{
    public function getAllCategories($validation = null)
    {
        $req = parent::getAll('categories', $validation);
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category($data);
            $allCategories [] = $category;
        }
        $req->closeCursor();
        return $allCategories;
    }

    public function getCategory($id)
    {
        $req = Database::getPDO()->prepare("SELECT * FROM categories WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        $category = new Category($data);
        return $category;
    }

    public function addCategory(Object $category, $imagePath)
    {
        $req = Database::getPDO()->prepare("INSERT INTO categories (title, imagePath, validate) 
                                        VALUES (:title, :imagePath, :validate)");
        $req->bindValue(':title', $category->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':imagePath', $imagePath, PDO::PARAM_STR);
        $req->bindValue(':validate', $category->getValidate(), PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function updateCategory($id, $attribute, $value)
    {
        $req = Database::getPDO()->prepare("UPDATE categories SET $attribute = :valueAttribute WHERE id = :id");
        $req->bindValue(':valueAttribute', $value);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function deleteCategory($id)
    {
        $req = Database::getPDO()->prepare("DELETE FROM categories WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function existsCategory($id)
    {
        $req = Database::getPDO()->prepare('SELECT title FROM categories WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->CloseCursor();
        if($data) {
            return true;
        }
    }
}
