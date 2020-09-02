<?php
namespace App\library\Model;

use App\library\BlogFram\Database;
use App\library\Entity\Comment;
use \PDO;

class CommentManager extends Database
{
    
    public function getAllComments($validation = null)
    {
        if(!empty($validation)) {
            $req = $this->getPDO()->prepare("SELECT * FROM comments WHERE validate = :validate");
            $req->bindValue(':validate', $validation, PDO::PARAM_INT);
        } else {
            $req = $this->getPDO()->query("SELECT * FROM comments");
        }
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment($data);
            $allComments [] = $comment;
        }
        $req->closeCursor();
        return $allComments;
    }

    public function getAllCommentsByArticle($idArticle)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM comments WHERE idArticle = :idArticle");
        $req->bindValue(':idArticle', $idArticle, PDO::PARAM_INT);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment($data);
            $allComments [] = $comment;
        }
        $req->closeCursor();
        return $allComments;
    }

    public function getComment($id)
    {
        $req = $this->getPDO()->prepare("SELECT * FROM comments WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        $comment = new Comment($data);
        return $comment;
    }

    public function addComment(Object $comment)
    {
        $req = $this->getPDO()->prepare("INSERT INTO comments (content, dateComment, idUser, idArticle, validate) 
                                        VALUES (:content, NOW(), :idUser, :idArticle, :validate)");
        $req->bindValue(':content', $comment->getContent(), PDO::PARAM_STR);
        $req->bindValue(':idUser', $comment->getIdUser(), PDO::PARAM_INT);
        $req->bindValue(':idArticle', $comment->getIdArticle(), PDO::PARAM_INT);
        $req->bindValue(':validate', $comment->getValidate(), PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
        header('Location:'. URL . 'admin');
    }

    public function updateComment($id, $attribute, $value)
    {
        $req = $this->getPDO()->prepare("UPDATE comments SET $attribute = :valueAttribute WHERE id = :id");
        $req->bindValue(':valueAttribute', $value);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();    
    }

    public function deleteComment($id)
    {
        $req = $this->getPDO()->prepare("DELETE FROM comments WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function countCommentsByArticle($idArticle, $validation)
    {
        if(isset($idArticle) AND isset($validation) AND !empty($idArticle) AND !is_null($validation)) {
            $req = $this->getPDO()->prepare("SELECT COUNT(*) FROM comments WHERE idArticle = :idArticle AND validate = :validate");
            $req->bindValue(':idArticle', $idArticle, PDO::PARAM_INT);
            $req->bindValue(':validate', $validation, PDO::PARAM_INT);
        } else if(isset($idArticle) AND !empty($idArticle) AND is_null($validation)){
            $req = $this->getPDO()->prepare("SELECT COUNT(*) FROM comments WHERE idArticle = :idArticle");
            $req->bindValue(':idArticle', $idArticle, PDO::PARAM_INT);
        }
        $data = $req->fetch();
        $req->closeCursor();
        return (int) $data[0];
    }

}