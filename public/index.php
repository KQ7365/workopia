<?php
//everything starts here!


require '../helpers.php';
require basePath('Router.php');
require basePath('Database.php');

//This is important (instatiating the router), line below this comment has to be above the require. Now we can access it anywhere
$router = new Router();
//GET routes
$routes = require basePath('routes.php');
//Get current URI and HTTP method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
//Route the request
$router->route($uri, $method);