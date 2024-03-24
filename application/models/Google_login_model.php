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
            'uid' => $data['login_oauth_uid'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email_address' => $data['email_address'],
            'profile_picture' => $data['profile_picture'],
            'created_at' => $data['created_at']
        ];
    }
}