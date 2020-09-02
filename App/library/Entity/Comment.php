<?php
namespace App\library\Entity;

use App\library\BlogFram\Entity;

class Comment extends Entity
{
    private $id;
    private $idUser;
    private $idArticle;
    private $content;
    private $dateComment;
    private $validate;

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getIdArticle()
    {
        return $this->idArticle;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDateComment()
    {
        return $this->dateComment;
    }

    public function getValidate()
    {
        return $this->validate;
    }
    
    // SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
    
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function setDateComment($dateComment)
    {
        $this->dateComment = $dateComment;
    }

    public function setValidate($validate)
    {
        $this->validate = $validate;
    }
}
