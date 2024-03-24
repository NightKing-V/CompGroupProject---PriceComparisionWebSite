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
                    $productArray = json_decode(json_encode($product), true);
                    $productArray['count'] = $item['count'];
                    $trendingProducts[] = $productArray;
                }
            }
        }
        return $trendingProducts;
    }



    public function add_favourites($productID, $email) {

        if ($email !== null) {

            $collection = $this->database->selectCollection('user_fav');
    
            $filter = ['email' => $email];
            $update = [
                '$setOnInsert' => [
                    'email' => $email, 
                    'productID' => $productID
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
                error_log('Error in add_count: ' . $e->getMessage());
                return 'error';
            }
        } else {
            return 'User not logged in';
        }
    }
      
    

    public function get_favourites() {
        $Collection = $this->database->selectCollection('user_fav');
        $favItems = $Collection->find([], [
            'sort' => ['updated_at' => -1]
        ])->toArray();
        
        $favourites = [];
        if ($favItems) {
            foreach ($favItems as $item) {
                $categoryCollection = $this->database->selectCollection($item['product_category']);
                try {
                    $productId = new MongoDB\BSON\ObjectId($item['product_id']);
                } catch (Exception $e) {
                    error_log("Error converting product_id to ObjectId: " . $e->getMessage());
                    continue; 
                }
                
                $product = $categoryCollection->findOne(['_id' => $productId]);
    
                if ($product) {
                    $productArray = json_decode(json_encode($product), true);
                    $productArray['count'] = $item['count'];
                    $favourites[] = $productArray;
                }
            }
        }
        return $trendingProducts;
    }
}