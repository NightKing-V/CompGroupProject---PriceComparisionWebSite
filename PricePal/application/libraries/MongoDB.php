<?php
defined('BASEPATH') or exit ('No direct script access allowed');

require_once __DIR__ . '/../../vendor/autoload.php';
class MongoDB {

    function __construct()
    {
        $uri = 'mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/';
        $client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
    }

}