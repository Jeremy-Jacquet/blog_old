<?php
namespace App\library\Entity;

use App\library\BlogFram\Entity;

class Author extends Entity
{

    private $id;
    private $firstname;
    private $lastname;
    private $imagePath;
    private $validate;

    //GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function getValidate()
    {
        return $this->validate;
    }

    //SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
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
