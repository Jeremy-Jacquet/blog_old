<?php
namespace App\library\Entity;

use App\library\BlogFram\Entity;

class Article extends Entity
{
    private $id;
    private $title;
    private $sentence;
    private $content;
    private $dateArticle;
    private $idAuthor;
    private $idCategory;
    private $imagePath;
    private $validate;
    
    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSentence()
    {
        return $this->sentence;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDateArticle()
    {
        return $this->dateArticle;
    }

    public function getIdAuthor()
    {
        return $this->idAuthor;
    }

    public function getIdCategory()
    {
        return $this->idCategory;
    }

    public function getImagePath()
    {
        return $this->imagePath;
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

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setSentence($sentence)
    {
        $this->sentence = $sentence;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function setDateArticle($dateArticle)
    {
        $this->dateArticle = $dateArticle;
    }

    public function setIdAuthor($idAuthor)
    {
        $this->idAuthor = $idAuthor;
    }

    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }

    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function setValidate($validate)
    {
        $this->validate = $validate;
    }

}