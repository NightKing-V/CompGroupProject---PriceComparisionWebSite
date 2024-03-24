<?php
session_start(); // Start a new session or resume the existing one
require_once 'vendor/autoload.php';

$clientID = '700745614672-1kdqi1qe36gguegcm72ho48mr89fqoup.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/auth.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
