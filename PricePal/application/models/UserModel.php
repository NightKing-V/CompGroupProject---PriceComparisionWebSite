<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class UserModel extends CI_model
{

    function __construct()
    {
        $this->load->library('mongodb');
    }

    function getrecords()
    {
        $collection = (new MongoDB\Client)->PricePal->refridgerator;
        $document = $collection->findOne(['_id' => '65fada7f275605ffac4cc3f9']);
        return $document;
    }
}
