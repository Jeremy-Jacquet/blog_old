<?php

define("URL", str_replace("public/index.php", "",(isset($_SERVER['HTTPS']) ? "https" : "http")."://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));

define('HOME', 'accueil');
define('POSTS', 'articles');
define('CATEGORIES', 'categories');
define('COMMENTS', 'commentaires');
define('AUTHORS', 'auteurs');
define('USERS', 'utilisateurs');
define('PROFILE', 'profil');
define('CONTACT', 'contact');
define('LOGIN', 'connexion');
define('REGISTER', 'inscription');
define('LOGOUT', 'deconnexion');
define('PUBLISH', 'publier');
define('ADMIN', 'admin');

define('DASHBOARD', 'dashboard');

define("ADD", 'ajouter');
define("UP", 'modifier');
define("DEL", 'supprimer');

define("ADMIN_ACCESS", 'admin');
define("AUTHOR_ACCESS", 'author');
define("USER_ACCESS", 'user');

define('ERROR', 'error');

define("PERMITTED_CHARS", "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
define("RANDOM_PATH", random_int(0, 1000).substr(str_shuffle(PERMITTED_CHARS), 0, 5));

define("TARGET_IMAGE_BLOG", "assets/img/post/");
define("TARGET_IMAGE_AVATAR", "assets/img/post/");

define("NAME_IMAGE_BLOG", "blog");
define("NAME_IMAGE_AVATAR", "avatar");

define("COOKIE_PROTECT", "timer");