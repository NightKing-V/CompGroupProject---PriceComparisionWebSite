<?php
class Google_login_model extends CI_Model
{
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
        $client = new MongoDB\Client('mongodb+srv://pricepal:MfN7VPqdfzKlakp8@pricepalcluster.pqeq3pm.mongodb.net/');
        $database = $client->selectDatabase('PricePal');
        $collection = $database->selectCollection('user_google');

        // Create a new document to insert
        $document = [
            'uid' => $data['Token'],
            'first_name' => $data['First_name'],
            'last_name' => $data['Last_name'],
            'email_address' => $data['Gmail'],
            'profile_picture' => $data['Picture'],
        ];
        $insertOneResult = $collection->insertOne( $document );
    }
}