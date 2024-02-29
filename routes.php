<?php

//now can add any new route to this file
// so /listings is the URL we want, and then after comma is where to look
$router->get('/', 'controllers/home.php');
$router->get('/listings', 'controllers/listings/index.php');
$router->get('/listings/create', 'controllers/listings/create.php');