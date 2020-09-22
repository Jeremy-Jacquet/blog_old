<?php
namespace App\library\Model;

use App\library\BlogFram\Database;
use App\library\BlogFram\Manager;
use App\library\Entity\Author;
use \PDO;

class AuthorManager extends Manager
{
    
    public function getAllAuthors($validation = null)
    {
        $req = parent::getAll('authors', $validation);
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $author = new Author($data);
            $allAuthors [] = $author;
        }
        $req->closeCursor();
        return $allAuthors;
    }

    public function getAuthor($id)
    {
        $req = Database::getPDO()->prepare("SELECT * FROM authors WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        $author = new Author($data);
        return $author;
    }

    public function addAuthor(Author $author, $imagePath)
    {
        $req = Database::getPDO()->prepare("INSERT INTO authors (firstname, lastname, imagePath, validate) 
                                        VALUES (:firstname, :lastname, :imagePath, :validate)");
        $req->bindValue(':firstname', $author->getFirstname(), PDO::PARAM_STR);
        $req->bindValue(':lastname', $author->getLastname(), PDO::PARAM_STR);
        $req->bindValue(':imagePath', $imagePath, PDO::PARAM_STR);
        $req->bindValue(':validate', $author->getValidate(), PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function updateAuthor($id, $attribute, $value)
    {
        $req = Database::getPDO()->prepare("UPDATE authors SET $attribute = :valueAttribute WHERE id = :id");
        $req->bindValue(':valueAttribute', $value);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function deleteAuthor($id)
    {
        $req = Database::getPDO()->prepare("DELETE FROM authors WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }
    
}
