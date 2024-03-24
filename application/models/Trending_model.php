<?php
require_once __DIR__ . '/../../vendor/autoload.php';
class Trending_model extends CI_Model
{
    private $client;
    private $database;

    public function __construct()
    {
        parent::__construct();

        $this->config->load('mongodb', TRUE);
        $mongo = $this->config->item('mongo_db', 'mongodb');
        $this->client = new MongoDB\Client($mongo['dsn']);
        $this->database = $this->client->selectDatabase($mongo['database']);
    }

    public function add_count($productID, $category) {

        $categoryCollection = $this->database->selectCollection($category);
        $mongoId = new MongoDB\BSON\ObjectId($productID);
        
        $product = $categoryCollection->findOne(['_id' => $mongoId]);
        
        if ($product !== null) {

            $productTitle = $product['title'];
            $collection = $this->database->selectCollection('trending_items');
    
            $filter = ['product_id' => $productID];
            $update = [
                '$setOnInsert' => [
                    'product_category' => $category, 
                    'product_title' => $productTitle,
                    'product_ref' => $mongoId
                ],
                '$inc' => ['count' => 1]
            ];
            $options = ['upsert' => true];
            
            try {
                $result = $collection->updateOne($filter, $update, $options);
                
                if ($result->getUpsertedCount() > 0) {
                    return 'inserted';
                } elseif ($result->getModifiedCount() > 0) {
                    return 'updated';
                } else {
                    return 'no action';
                }
            } catch (Exception $e) {
                error_log('Error in add_count: ' . $e->getMessage());
                return 'error';
            }
        } else {
            return 'product not found';
        }
    }
      
    

    public function get_trending_products($limit) {
        $trendingCollection = $this->database->selectCollection('trending_items');
        $trendingItems = $trendingCollection->find([], [
            'limit' => $limit, 
            'sort' => ['count' => -1]
        ])->toArray();
        
        $trendingProducts = [];
        if ($trendingItems) {
            foreach ($trendingItems as $item) {
                $categoryCollection = $this->database->selectCollection($item['product_category']);
                try {
                    $productId = new MongoDB\BSON\ObjectId($item['product_id']);
                } catch (Exception $e) {
                    error_log("Error converting product_id to ObjectId: " . $e->getMessage());
                    continue; 
                }
                
                $product = $categoryCollection->findOne(['_id' => $productId]);
    
                if ($product) {
                    $product->count = $item['count'];
                    $trendingProducts[] = $product;
                }
                
            }
        }
        return $trendingProducts;
    }



    public function add_favourites($productID, $email, $category) {
        if (!empty($email)) {
            $collection = $this->database->selectCollection('user_fav');
            $mongoId = new MongoDB\BSON\ObjectId($productID);
            $productUniqueIdentifier = $productID . '_' . $category;
    
            $filter = ['email' => $email];
            $update = [
                '$setOnInsert' => [
                        'productID' => $productID,
                        'product_category' => $category,
                        'product_ref' => $mongoId,
                        'unique_identifier' => $productUniqueIdentifier
                ]
            ];
            $options = ['upsert' => true];
            
            try {
                $result = $collection->updateOne($filter, $update, $options);
                
                if ($result->getUpsertedCount() > 0) {
                    return 'inserted';
                } elseif ($result->getModifiedCount() > 0) {
                    return 'updated';
                } else {
                    return 'no action';
                }
            } catch (Exception $e) {
                error_log('Error in add_favourites: ' . $e->getMessage());
                return 'error';
            }
        } else {
            return 'email required';
        }
    }
      
    

    public function get_favourites() {
        $manager = new MongoDB\Driver\Manager('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');

        $filter = [];

        $options = [
            'sort' => ['updated_at' => -1]
        ];

        // Create a new query with the filter and options
        $query = new MongoDB\Driver\Query($filter, $options);

        // Execute the query on a specific collection and get the cursor
        $cursor = $manager->executeQuery("PricePal.user_fav", $query);


        foreach ($cursor as $document) {
            $combinedResults[] = $document;
        }
      
        return $combinedResults;
    }
}