<?php
namespace App\library\Model;

use App\library\BlogFram\Database;
use App\library\Entity\Article;
use \PDO;

class ArticleManager extends Database
{
    public function getAllArticles($validation = null)
    {
        if(!empty($validation)) {
                $req = $this->getPDO()->prepare("SELECT * FROM articles WHERE validate = :validate");
                $req->bindValue(':validate', $validation, PDO::PARAM_INT);
        } else {
            $req = $this->getPDO()->query("SELECT * FROM articles");
        }
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article($data);
            $allArticles [] = $article;
        }
        $req->closeCursor();
        return $allArticles;

    }

    public function getLastArticles($numberArticles)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM articles WHERE validate = 1 ORDER BY id DESC LIMIT :numberArticles");
        $req->bindValue(':numberArticles', $numberArticles, PDO::PARAM_INT);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article($data);
            $lastArticles [] = $article;
        }
        $req->closeCursor();
        return $lastArticles;
    }

    public function getAllArticlesByCategory($idCategory)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM articles WHERE idCategory = :idCategory");
        $req->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article($data);
            $allArticles [] = $article;
        }
        $req->closeCursor();
        return $allArticles;
    }

    public function getArticle($id)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM articles WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        $article = new Article($data);
        return $article;
    }

    public function addArticle(Object $article, $imagePath)
    {
        $req = $this->getPDO()->prepare("INSERT INTO articles (title, sentence, content, dateArticle, idAuthor, idCategory, imagePath, validate) 
                                        VALUES (:title, :sentence, :content, NOW(), :idAuthor, :idCategory, :imagePath, :validate)");
        $req->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':sentence', $article->getSentence(), PDO::PARAM_STR);
        $req->bindValue(':content', $article->getContent(), PDO::PARAM_STR);
        $req->bindValue(':idAuthor', $article->getIdAuthor(), PDO::PARAM_INT);
        $req->bindValue(':idCategory', $article->getIdCategory(), PDO::PARAM_INT);
        $req->bindValue(':imagePath', $imagePath, PDO::PARAM_STR);
        $req->bindValue(':validate', $article->getValidate(), PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function updateArticle($id, $attribute, $value)
    {
        $req = $this->getPDO()->prepare("UPDATE articles SET $attribute = :valueAttribute WHERE id = :id");
        $req->bindValue(':valueAttribute', $value);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function deleteArticle($id)
    {
        $req = $this->getPDO()->prepare("DELETE FROM articles WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function existsArticle($id)
    {
        $req = $this->getPDO()->prepare('SELECT title FROM articles WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->CloseCursor();
        if($data) {
            return true;
        }
    }


}