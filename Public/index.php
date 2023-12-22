<?php

// chemin racine
define('ROOT_PATH', __DIR__);

// url racine
// A MODIFIER 
define('ROOT_URL', 'http://localhost/TPBlog');
// A MODIFIER 

// Appel de l'autoload
require_once ROOT_PATH . '/../Core/Autoloader.php';
Autoloader::register();

// Appel du request
// require_once ROOT_PATH . '/../Core/Request.php';
$request = new \Core\Request;

// Appel du router avec l'argument request
$router = new \Core\Router($request);
$router->route();
