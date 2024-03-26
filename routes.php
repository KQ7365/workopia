<?php

//now can add any new route to this file
// so /listings is the URL we want, and then after comma is where to look

$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create');
$router->get('/listing/{id}', 'ListingController@show');


