<?php

require 'App/config/Database.php';

use App\library\BlogFram\SuperGlobals;

$superGlobals = new SuperGlobals;
$page = htmlspecialchars($superGlobals->get_GET['page']);

try {

    if(empty($page)) {
        //Go to home
    } else {
        throw new Exception("La page que vous recherchez n'existe pas.");
    }

} catch(Exception $e) {
    $error = $e->getMessage();
}