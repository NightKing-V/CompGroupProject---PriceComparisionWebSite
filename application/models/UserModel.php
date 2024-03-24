<?php
defined('BASEPATH') or exit ('No direct script access allowed');
require_once __DIR__ . '/../../vendor/autoload.php';
class UserModel extends CI_model
{

    function getrecords($searchtext)
    {
        $client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        $db = $client->PricePal;
        $collection = $db->refridgerator;
        $id = $searchtext;
        $theObjId = new MongoDB\BSON\ObjectId($id);
        $document = $collection->findOne(array('_id' => $theObjId));
        $result = iterator_to_array($document);
        // return $document;
        // $result = $client->PricePal->createCollection('yooooo');
        return $result;
    }
    function youmaylike()
    {
        // $client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        // $db = $client->PricePal;
        // $collection = $db->refridgerator;
        // $id = $searchtext;
        // $theObjId = new MongoDB\BSON\ObjectId($id);
        // $document = $collection->findOne(array('_id' => $theObjId));
        // $result = iterator_to_array($document);
        // // return $document;
        // // $result = $client->PricePal->createCollection('yooooo');
        return null;
    }
    function bestselling()
    {
        // $client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        // $db = $client->PricePal;
        // $collection = $db->refridgerator;
        // $id = $searchtext;
        // $theObjId = new MongoDB\BSON\ObjectId($id);
        // $document = $collection->findOne(array('_id' => $theObjId));
        // $result = iterator_to_array($document);
        // return $document;
        // $result = $client->PricePal->createCollection('yooooo');
        return null;
    }
    function newarrivals($limit)
    {
        //$client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        $manager = new MongoDB\Driver\Manager('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');

        $filter = [];

        $options = [
            'limit' => $limit,
            'sort' => ['updated_at' => -1]
        ];

        // Create a new query with the filter and options
        $query = new MongoDB\Driver\Query($filter, $options);

        // Execute the query on a specific collection and get the cursor
        $cursor1 = $manager->executeQuery("PricePal.refridgerator", $query);
        $cursor2 = $manager->executeQuery("PricePal.rice_cooker", $query);


        foreach ($cursor1 as $document) {
            $combinedResults[] = $document;
        }
        foreach ($cursor2 as $document) {
            $combinedResults[] = $document;
        }
        return $combinedResults;
    }
    function hotdeals($limit)
    {
        //$client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        $manager = new MongoDB\Driver\Manager('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');

        $filter = [];

        $options = [
            'limit' => $limit,
            'sort' => ['new_price' => 1]
        ];

        // Create a new query with the filter and options
        $query = new MongoDB\Driver\Query($filter, $options);

        // Execute the query on a specific collection and get the cursor
        $cursor1 = $manager->executeQuery("PricePal.refridgerator", $query);
        $cursor2 = $manager->executeQuery("PricePal.rice_cooker", $query);


        foreach ($cursor1 as $document) {
            $combinedResults[] = $document;
        }
        foreach ($cursor2 as $document) {
            $combinedResults[] = $document;
        }
        return $combinedResults;
    }
}
