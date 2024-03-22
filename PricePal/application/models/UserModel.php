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
    function newarrivals()
    {
        //$client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        $manager = new MongoDB\Driver\Manager('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        // $db = $client->PricePal;
        // $collection = $db->refridgerator;
        // $id =
        //     // $theObjId = new MongoDB\BSON\ObjectId($id);
        //     $document = $collection->find(
        //         array(
        //             'updated_at',
        //             'sort' => '1'
        //         )
        //     );
        // $result = iterator_to_array($document);
        // return $document;
        // $result = $client->PricePal->createCollection('yooooo');
        $filter = [];

        // Define your options, including the sort order
        // 1 for ascending order, -1 for descending order
        $options = [
            'limit' => '4',
            'sort' => ['updated_at' => 1]
        ];

        // Create a new query with the filter and options
        $query = new MongoDB\Driver\Query($filter, $options);

        // Execute the query on a specific collection and get the cursor
        $cursor = $manager->executeQuery("PricePal.refridgerator", $query);
        //$document = $cursor->toArray();
        return $cursor;
        // $result = iterator_to_array($document);
        // return $result;
    }
}
