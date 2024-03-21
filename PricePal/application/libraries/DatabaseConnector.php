<?php
 
namespace application\libraries;

class DatabaseConnector {
    private $client;
    private $database;

    function __construct() {
        $uri = getenv('ATLAS_URI');
        $database = getenv('DATABASE');

        if (empty($uri) || empty($database)) {
            show_error('You need to declare ATLAS_URI and DATABASE in your .env file!');
        }

        try {
            $this->client = new \MongoDB\Client($uri);
        } catch(mongodb\mongodb\src\Execption\Exception $ex) {
            show_error('Couldn\'t connect to database: ' . $ex->getMessage(), 500);
        }

        try {
            $this->database = $this->client->selectDatabase($database);
        } catch(mongodb\mongodb\src\Execption\RuntimeException $ex) {
            show_error('Error while fetching database with name: ' . $database . $ex->getMessage(), 500);
        }
    }

    function getDatabase() {
        return $this->database;
    }
}