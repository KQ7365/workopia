<?php

//getting the config from the database
$config = require basePath('config/db.php');
//instantiate the database
$db = new Database($config);
//now use Query method we made from Database.php and fetching all
$listings = $db->query('SELECT * From listings Limit 6')->fetchAll();

//test it
inspect($listings);

loadView('home');