<?php
namespace App\library\BlogFram;

use \PDO;

abstract class Database 
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'blog_perso_2';
    const DB_USER = 'root';
    const DB_PSWD = '';

    private static $pdo;

    private static function setPDO()
    {
        self::$pdo = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME.";charset=utf8", self::DB_USER, self::DB_PSWD);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    public static function getPDO()
    {
        if(self::$pdo === null) {
            self::setPDO();
        }
        return self::$pdo;
    }

}