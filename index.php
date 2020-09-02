<?php

require 'App/config/Database.php';

try {

    if(empty($_GET['page']))
    {
        //Go to home

    } else {
        throw new Exception("La page que vous recherchez n'existe pas.");
    }

} catch(Exception $e) {
    $error = $e->getMessage();
}