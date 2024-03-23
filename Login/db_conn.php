<?php
require_once 'vendor/autoload.php';
$mongoConnectionString = "mongodb://localhost:27017";
try {
    // Create MongoDB client instance
    $mongoClient = new MongoDB\Client($mongoConnectionString);
    
    // Select database
    $mongoDatabase = $mongoClient->selectDatabase("PricePal");
} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Error connecting to MongoDB server');
}
