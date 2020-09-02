<?php
namespace App\library\Entity;

use App\library\BlogFram\Entity;

class User extends Entity
{
    private $id;
    private $pseudo;
    private $pass;
    private $email;
    private $imagePath;
    private $dateRegistration;
    private $newsletter;
    private $access;
    private $validate;

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function getDateRegistration()
    {
        return $this->dateRegistration;
    }

    public function getNewsletter()
    {
        return $this->newsletter;
    }

    public function getAccess()
    {
        return $this->access;
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
    
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    
    public function setEmail($email)
    {
        return $this->email = $email;
    }
    
    public function setImagePath($imagePath)
    {
        return $this->imagePath = $imagePath;
    }
    
    public function setDateRegistration($dateRegistration)
    {
        $this->dateRegistration = $dateRegistration;
    }
    
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
    }
    
    public function setAccess($access)
    {
        $this->access = $access;
    }
    
    public function setValidate($validate)
    {
        $this->validate = $validate;
    }
} 
