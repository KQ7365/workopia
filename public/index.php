<?php
//everything starts here!


require '../helpers.php';
require basePath('Framework/Router.php');
require basePath('Framework/Database.php');

//autloader will make it so a Class can be autloaded an no need for requires
spl_autoload_register(function ($class){
    $path = basePath('Framework/' . $class . '.php');
    if(file_exists($path)) {
        require $path;
    }
});

//This is important (instantiate the router), line below this comment has to be above the require. Now we can access it anywhere
$router = new Router();
//GET routes
$routes = require basePath('routes.php');
//Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
//Route the request
$router->route($uri, $method);