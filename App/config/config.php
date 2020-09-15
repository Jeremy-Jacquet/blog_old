<?php

define("URL", str_replace("index.php", "",(isset($_SERVER['HTTPS']) ? "https" : "http")."://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));

define('HOME', 'accueil');
define('POSTS', 'articles');
define('CATEGORIES', 'categories');
define('COMMENTS', 'commentaires');
define('AUTHORS', 'auteurs');
define('USERS', 'utilisateurs');
define('PROFILE', 'profil');
define('LOGIN', 'connexion');
define('REGISTER', 'inscription');
define('LOGOUT', 'deconnexion');
define('ADMIN', 'admin');

define('DASHBOARD', 'dashboard');

define("ADD", 'ajouter');
define("UP", 'modifier');
define("DEL", 'supprimer');