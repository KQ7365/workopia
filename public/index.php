<?php
//everything starts here!

require __DIR__ . '/../vendor/autoload.php';

require '../helpers.php';

use Framework\Router;

//This is important (instantiate the router), line below this comment has to be above the require. Now we can access it anywhere
$router = new Router();
//GET routes
$routes = require basePath('routes.php');
//Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
//Route the request
$router->route($uri, $method);