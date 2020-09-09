<?php
namespace App\library\Model;

use App\library\BlogFram\Database;
use App\library\BlogFram\Manager;
use App\library\Entity\User;
use \PDO;

class UserManager extends Manager
{

    public function getAllUsers($validation = null)
    {
        $req = parent::getAll('users', $validation);
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($data);
            $allUsers [] = $user;
        }
        $req->closeCursor();
        return $allUsers; 
    }

    public function getUser($id)
    {
        $req = Database::getPDO()->prepare("SELECT * FROM users WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        $user = new User($data);
        return $user;
    }

    public function getUserByPseudo($pseudo)
    {
        $req = Database::getPDO()->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        $user = new User($data);
        return $user;
    }

    public function addUser($userArray)
    {
        $user = new User($userArray);
        $req = Database::getPDO()->prepare("INSERT INTO users (pseudo, pass, email, imagePath, dateRegistration, newsletter, access, validate) 
                                        VALUES (:pseudo, :pass, :email, :imagePath, NOW(), :newsletter, :access, :validate)");
        $req->bindValue(':pseudo', $user->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(':pass', $user->getPass(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':imagePath', $user->getImagePath(), PDO::PARAM_STR);
        $req->bindValue(':newsletter', $user->getNewsletter(), PDO::PARAM_INT);
        $req->bindValue(':access', $user->getAccess(), PDO::PARAM_INT);
        $req->bindValue(':validate', $user->getValidate(), PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
        header('Location:'. URL . 'admin');
    }

    public function updateUser($id, $attribute, $value)
    {
        $req = Database::getPDO()->prepare("UPDATE users SET $attribute = :valueAttribute WHERE id = :id");
        $req->bindValue(':valueAttribute', $value);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();   
    }

    public function deleteUser($id)
    {
        $req = Database::getPDO()->prepare("DELETE FROM users WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }

    public function existsUser($pseudo, $pass)
    {
        $req = Database::getPDO()->prepare('SELECT pass FROM users WHERE pseudo = :pseudo');
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if(password_verify($pass, $data['pass'])) {
            return true;
        }
    }

    public function existsPseudo($pseudo)
    {
        $req = Database::getPDO()->prepare('SELECT id FROM users WHERE pseudo = :pseudo');
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        if(!$data) {      
            return true;
        }
    }

}
