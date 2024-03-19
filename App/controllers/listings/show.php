<?php


use Framework\Database;
//getting the config from the database
$config = require basePath('config/db.php');
//instantiate the database
$db = new Database($config);

$id = $_GET['id'] ?? '';
// inspect($id);

//add params array now to protect DB
$params = [
    'id' => $id
];

$listing = $db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

// inspect($listing);

loadView('listings/show', [
    'listing' => $listing
]);