<?php
namespace App\library\BlogFram;

use App\library\BlogFram\Database;
use \PDO;

abstract class Manager
{

    public function getAll($from, $validation = null)
    {
        if(!empty($validation)) {
            $req = Database::getPDO()->prepare("SELECT * FROM $from WHERE validate = :validate");
            $req->bindValue(':validate', $validation, PDO::PARAM_INT);
        } else {
            $req = Database::getPDO()->query("SELECT * FROM $from");
        }
        $req->execute();
        return $req;
    }

    public function getAllBy($from, $where, $id)
    {
        $req = Database::getPDO()->prepare("SELECT * FROM $from WHERE $where = :$where");
        $req->bindValue(':'.$where, $id, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }
}
