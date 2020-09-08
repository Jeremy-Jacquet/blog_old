<?php
require '../vendor/autoload.php';
require "../App/config/config.php";

use App\library\BlogFram\Router;

$router = new Router;

try {

    $router->run();

} catch(Exception $e) {
    $error = $e->getMessage();
}