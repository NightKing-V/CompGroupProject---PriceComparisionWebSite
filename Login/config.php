<?php
session_start(); // Start a new session or resume the existing one
require_once 'vendor/autoload.php';

$clientID = '891878224579-1nbf692cgc0ff0r023n4c2ia367eihfl.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/auth.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");