<?php
namespace App\library\BlogFram;

use \PDO;

abstract class Database 
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'blog_perso_2';
    const DB_USER = 'root';
    const DB_PSWD = 'root';

    private static $pdo;

    private function setPDO()
    {
        self::$pdo = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME.";charset=utf8", self::DB_USER, self::DB_PSWD);
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