<?php
namespace App\library\Entity;

use App\library\BlogFram\Entity;

class Category extends Entity
{
    private $id;
    private $title;
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

    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function setValidate($validate)
    {
        $this->validate = $validate;
    }
}
