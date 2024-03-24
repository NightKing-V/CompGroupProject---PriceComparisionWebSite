<?php
defined('BASEPATH') or exit ('No direct script access allowed');
require_once __DIR__ . '/../../vendor/autoload.php';
class UserModel extends CI_model
{

    function getrecords($searchtext)
    {
        $manager = new MongoDB\Driver\Manager('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        $searchtext = (string) $searchtext;
        $filter = [
            'title' => ['$regex' => $searchtext, '$options' => 'i']
        ];

        $options = [
            'sort' => ['updated_at' => -1]
        ];

        // Create a new query with the filter and options
        $query = new MongoDB\Driver\Query($filter, $options);

        // Execute the query on a specific collection and get the cursor
        $cursor1 = $manager->executeQuery("PricePal.refridgerator", $query);
        $cursor2 = $manager->executeQuery("PricePal.rice_cooker", $query);

        $combinedResults = [];
        foreach ($cursor1 as $document) {
            $combinedResults[] = $document;
        }
        foreach ($cursor2 as $document) {
            $combinedResults[] = $document;
        }
        return $combinedResults;
    }
    function getcategory($searchtext)
    {
        $manager = new MongoDB\Driver\Manager('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        $combinedResults = [];
        switch ($searchtext) {
            case 'Refrigerators':
                $filter = [
                    'title' => ['$regex' => 'refri', '$options' => 'i']
                ];

                $options = [
                    'sort' => ['updated_at' => -1]
                ];

                // Create a new query with the filter and options
                $query = new MongoDB\Driver\Query($filter, $options);

                // Execute the query on a specific collection and get the cursor
                $cursor = $manager->executeQuery("PricePal.refridgerator", $query);
                foreach ($cursor as $document) {
                    $combinedResults[] = $document;
                }
                break;

            case "Kitchen Appliances":
                $filter = [
                    'title' => ['$regex' => 'cook', '$options' => 'i']
                ];

                $options = [
                ];

                // Create a new query with the filter and options
                $query = new MongoDB\Driver\Query($filter, $options);

                // Execute the query on a specific collection and get the cursor
                $cursor = $manager->executeQuery("PricePal.rice_cooker", $query);
                foreach ($cursor as $document) {
                    $combinedResults[] = $document;
                }
                break;
        }
        return $combinedResults;
    }
    function youmaylike()
    {
         //$client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
         $manager = new MongoDB\Driver\Manager('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');

         $filter = [];
 
         $options = [
             'limit' => '2',
             'sort' => ['updated_at' => 1]
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
    function bestselling()
    {
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
