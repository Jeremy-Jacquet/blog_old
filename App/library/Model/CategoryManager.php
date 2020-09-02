<?php
namespace App\library\Model;

use App\library\BlogFram\Database;
use App\library\Entity\Category;
use \PDO;

class CategoryManager extends Database
{
    public function getAllCategories($validation = null)
    {
        if(!empty($validation)) {
            $req = $this->getPDO()->prepare("SELECT * FROM categories WHERE validate = :validate");
            $req->bindValue(':validate', $validation, PDO::PARAM_INT);
        } else {
            $req = $this->getPDO()->query("SELECT * FROM categories");
        }
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category($data);
            $allCategories [] = $category;
        }
        $req->closeCursor();
        return $allCategories;
    }

    public function getCategory($id)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM categories WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        $category = new Category($data);
        return $category;
    }

    public function addCategory(Object $category, $imagePath)
    {
        $req = $this->getPDO()->prepare("INSERT INTO categories (title, imagePath, validate) 
                                        VALUES (:title, :imagePath, :validate)");
        $req->bindValue(':title', $category->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':imagePath', $imagePath, PDO::PARAM_STR);
        $req->bindValue(':validate', $category->getValidate(), PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function updateCategory($id, $attribute, $value)
    {
        $req = $this->getPDO()->prepare("UPDATE categories SET $attribute = :valueAttribute WHERE id = :id");
        $req->bindValue(':valueAttribute', $value);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function deleteCategory($id)
    {
        $req = $this->getPDO()->prepare("DELETE FROM categories WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function existsCategory($id)
    {
        $req = $this->getPDO()->prepare('SELECT title FROM categories WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->CloseCursor();
        if($data) {
            return true;
        }
    }
}
