<?php

require 'App/config/Database.php';

try {

    if(isset($_GET['page'])) {
        $page = htmlspecialchars($_GET['page']);
    }

    if(empty($page)) {
        //Go to home
    } else {
        throw new Exception("La page que vous recherchez n'existe pas.");
    }

} catch(Exception $e) {
    $error = $e->getMessage();
}