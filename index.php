<?php

require 'App/config/Database.php';

use App\library\BlogFram\SuperGlobals;

$superGlobals = new SuperGlobals;
$page = null;

try {
    
    if(!empty($superGlobals->get_GET['page'])) {
        $page = htmlspecialchars($superGlobals->get_GET['page']);
    }

    if(empty($page)) {
        //Go to home
    } else {
        throw new Exception("La page que vous recherchez n'existe pas.");
    }

} catch(Exception $e) {
    $error = $e->getMessage();
}