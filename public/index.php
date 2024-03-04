<?php
//everything starts here!


require '../helpers.php';

require basePath('Database.php');
$config = require basePath('config/db.php');

$db = new Database($config);

require basePath('Router.php');

//This is important, line below this comment has to be above the require. Now we can access it anywhere
$router = new Router();

$routes = require basePath('routes.php');

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);