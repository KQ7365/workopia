<?php

namespace App\Controllers;

//we are using the database in this home page, so we must bring it in
use Framework\Database;

class ListingController {
    //only allow this class to use the following variable:
    protected $db;
    //PHP will automatically call this function (by using __construct) when you create an object from a class.
    public function __construct() {
       //getting the config from the database
        $config = require basePath('config/db.php');
        //this next line gives us access to the database in any method we create within this class
        $this->db = new Database($config);
    }

    public function index() {
        //Using the Query method we made from Database.php and fetching all
        $listings = $this->db->query('SELECT * From listings')->fetchAll();

        loadView('home', [
            'listings' => $listings
        ]);
    }

    public function create() {
       
    loadView('listings/create');
    }

    public function show() {
       
        $id = $_GET['id'] ?? '';
        // inspect($id);

        //add params array now to protect DB
        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

        // inspect($listing);

        loadView('listings/show', [
            'listing' => $listing
        ]);
                }
}