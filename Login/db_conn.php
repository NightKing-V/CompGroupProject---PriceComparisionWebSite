<?php
require_once 'vendor/autoload.php';
$mongoConnectionString = "mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/";
try {
    // Create MongoDB client instance
    $mongoClient = new MongoDB\Client($mongoConnectionString);
    
    // Select database
    $mongoDatabase = $mongoClient->selectDatabase("PricePal");
} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Error connecting to MongoDB server');
}
