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
        $email = $_SESSION['email'];
        $collection = $this->database->selectCollection('user_google');

        $result = $collection->findOne(['email_address' => $email]);
        if ($result === null) {
            return false;
        } else {
            return true;
        }

    }

    function Update_user_data($data)
    {
        $collection = $this->database->selectCollection('user_google');

        $updateResult = $collection->updateOne(
            ['email_address' => $data['email']], // Filter criteria.
            [
                '$set' => [
                    'uid' => $data['id'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email_address' => $data['email'],
                    'profile_picture' => $data['profile'],
                    'name' => $data['name']
                ]
            ] // Update operation.
        );

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

    // public function Get_user_data($email)
    // {
    //     $collection = $this->database->selectCollection('user_google');

    //     $result = $collection->findOne(['email_address' => $email]);

    //     if ($result !== null) {
    //         return json_decode(json_encode($result), true);
    //     } else {
    //         return null;
    //     }
    // }

    // public function Get_user_data()
    // {
    //     $email = $_SESSION['email'];
    //     $collection = $this->database->selectCollection('user_google');

    //     $result = $collection->findOne(['email_address' => $email]);

    //     if ($result !== null) {
    //         return json_decode(json_encode($result), true);
    //     } else {
    //         return null;
    //     }
    // }
}