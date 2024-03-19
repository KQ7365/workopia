<?php

namespace Framework;

use PDO;
use PDOException;
use Exception;

class Database {

    public $conn;

    //Constructor for Database class

    public function __construct($config) {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        //this options is very important. especially line 14, tells how we want the data to come in!
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];
        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e){
                throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }

    //Query the database!
    //will return a PDO statement because we want to this work with any fetch
    public function query($query, $params = []) {
        try{
            $sth = $this->conn->prepare($query);

            //Bind named params
            foreach($params as $param => $value) {
                $sth->bindValue(':' . $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute: {$e->getMessage()}");
        }
    }
}