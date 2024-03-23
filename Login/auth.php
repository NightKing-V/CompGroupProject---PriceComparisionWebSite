<?php
require_once './config.php';
require_once './db_conn.php';

if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  var_dump($token);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;

  $collection = $mongoDatabase->selectCollection("users");

  $existingUser = $collection->findOne(['email' => $email]);
  
  if ($existingUser) {
      // User exists
      $_SESSION['user_email'] = $email;
      // implement login 
      header('Location: /');
  } else {
      // register
      $collection->insertOne([
          'name' => $name,
          'email' => $email,
      ]);
      $_SESSION['user_email'] = $email;
      // implement login after register
      header('Location: /');
  }

} else {
//   echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
    header('Location:'.$client->createAuthUrl().'');
}
