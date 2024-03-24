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
        if (empty($email)) {
            return 'email required';
        }
    
        $collection = $this->database->selectCollection('user_fav');
        $document = $collection->findOne(['email' => $email]);
    
        if (!$document) {
            return 'Document not found.';
        }
    
        $isFavorite = false;
        $favDetail = [
            'productID' => $productID,
            'product_category' => $category,
            'product_ref' => new MongoDB\BSON\ObjectId($productID),
        ];
    
        // Check if already a favorite
        foreach ($document['favourites'] as $key => $favourite) {
            if ($favourite['productID'] == $productID) {
                $isFavorite = true;
                // Remove from favorites if it exists
                $updateResult = $collection->updateOne(
                    ['email' => $email],
                    ['$pull' => ['favourites' => $favourite]]
                );
                return "favourite removed";
                break;
            }
        }
    
        // Add to favorites if it wasn't found
        if (!$isFavorite) {
            $updateResult = $collection->updateOne(
                ['email' => $email],
                ['$push' => ['favourites' => $favDetail]],
                ['upsert' => true]
            );
        }
    
        try {
            if (isset($updateResult) && $updateResult->isAcknowledged()) {
                if ($isFavorite) {
                    return 'favourite removed';
                } else {
                    return $updateResult->getUpsertedCount() > 0 ? 'user created with favourite' : 'favourite added';
                }
            }
        } catch (Exception $e) {
            error_log('Error in add_favourites: ' . $e->getMessage());
            return 'error';
        }
    
        return 'no action required';
    }
    
    
      
    

    public function get_favourites() {
        $favCollection = $this->database->selectCollection('user_fav');
        $favItems = $favCollection->find(['email' => $_SESSION['email']])->toArray();
        $favouriteItems = [];
    
        if ($favItems) {
            foreach ($favItems as $item) {
                if (isset($item['product_category']) && isset($item['productID'])) {
                    $categoryCollection = $this->database->selectCollection($item['product_category']);
                    
                    try {
                        $productId = new MongoDB\BSON\ObjectId($item['productID']);
                        $product = $categoryCollection->findOne(['_id' => $productId]);
        
                        if ($product) {
                            $favouriteItems[] = $product;
                        }
                    } catch (Exception $e) {
                        error_log("Error converting product_id to ObjectId: " . $e->getMessage());
                    }
                }
            }
        }
    
        // Return $favouriteItems as an array of objects.
        return $favouriteItems;
    }
}