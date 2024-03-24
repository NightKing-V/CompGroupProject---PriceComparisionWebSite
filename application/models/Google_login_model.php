<?php
require_once __DIR__ . '/../../vendor/autoload.php';
class Google_login_model extends CI_Model
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

    function Is_already_register($id)
    {
        // $client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        // $database = $client->selectDatabase('PricePal');
        // $collection = $database->selectCollection('user_google');

        // // Create a new document to insert
        // $document = [
        //     'username' => 'newuser',
        //     'email' => 'newuser@example.com',
        //     'name' => 'New User'
        // ];
        return false;

    }

    function Update_user_data($data, $id)
    {
        $this->db->where('login_oauth_uid', $id);
        $this->db->update('chat_user', $data);
    }

    function Insert_user_data($data)
    {
        $collection = $this->database->selectCollection('user_google');

        // Create a new document to insert
        $document = [
            'uid' => $data['id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'name' => $data['name'],
            'email_address' => $data['email'],
            'profile_picture' => $data['profile'],
        ];
        $result = $collection->insertOne($document);
    }
    function Get_user_data($email)
    {
        //$client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        $manager = new MongoDB\Driver\Manager('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');

        $filter = [
            'email' => $email
        ];

        $options = [
            'limit' => '1' 
        ];

        // Create a new query with the filter and options
        $query = new MongoDB\Driver\Query($filter, $options);

        // Execute the query on a specific collection and get the cursor
        $cursor = $manager->executeQuery("PricePal.user_google", $query);
        foreach ($cursor as $dat) {
            $data[] = $dat; 
        }
        return $data;
    }
}