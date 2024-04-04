<?php

namespace App\Controllers;

//we are using the database in this home page, so we must bring it in
use Framework\Database;
use Framework\Validation;

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

    //show all listings
    public function index() {

        //Using the Query method we made from Database.php and fetching all
        $listings = $this->db->query('SELECT * From listings')->fetchAll();

        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

      //show create listing form
    public function create() {
       
    loadView('listings/create');
    }

      //show a single listing
    public function show($params) {
       
                    $id = $params['id'] ?? '';
                    // inspect($id);

                    //add params array now to protect DB
                    $params = [
                        'id' => $id
                    ];

                    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

                    //check if listing exists
                    if(!$listing) {
                        ErrorController::notFound('Listing not found');
                        return;
                    }

                    // inspect($listing);

                    loadView('listings/show', [
                        'listing' => $listing
                    ]);
                }

        //Store data in database (POST)
                //lets make it secure so only those fields inputted 
        public function store() {
        $allowedFields = ['title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits'];

        //use to PHP functions to secure these fields
            //array_intersect_key: this built in function takes in 2 arrays, and returns new array as long as key is in both arrays!!!!!
            //array_flip: So the allowedFields are not actualy 'keys', so wrapping it in this built in function that reverses and turns key into values and values into keys. 
            //So now these value will be Keys and match the POST keys.
        $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

        //just hardcoded for now
        $newListingData['user_id'] = 1;

        //using built in array_map to loop through our sanitized helper function we created in helpers.php
            //so forst argument is 'sanitize' because thats the name of the function/methid in helpers, and then our new listing data
            $newListingData = array_map('sanitize', $newListingData);

            inspectAndDie($newListingData);
        }
}