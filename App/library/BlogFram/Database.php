<?php
namespace App\library\BlogFram;

use \PDO;

require('App/config/Database.php');

abstract class Database 
{
    private static $pdo;

    private function setPDO()
    {
        self::$pdo = new PDO("mysql:host=".HOST.";dbname=".DB.";charset=utf8", USER_DB, PSWD_DB);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getPDO()
    {
        if(self::$pdo === null) {
            $this->setPDO();
        }
        return self::$pdo;
    }

}