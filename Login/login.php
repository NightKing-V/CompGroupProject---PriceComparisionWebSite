<?php 
session_start(); 
include "db_conn.php";
if (isset($_POST['mail']) && isset($_POST['pass'])) {
    function validate($data){
        if ($data === null) {
            throw new \InvalidArgumentException("data must not be null");
        }

        $data = trim($data);
        if ($data === "") {
            throw new \InvalidArgumentException("data must not be empty");
        }

        $data = stripslashes($data);
        if ($data === null) {
            throw new \RuntimeException("stripslashes() returned NULL");
        }

        $data = htmlspecialchars($data, ENT_QUOTES);
        if ($data === null) {
            throw new \RuntimeException("htmlspecialchars() returned NULL");
        }

        return $data;
    }

    $mail = validate($_POST['mail']);
    $pass = validate($_POST['pass']);
    if (empty($mail)) {
        header("Location: index.php?error=User Name is required");
        exit();
    }else if(empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    } else{
    $mongo = new MongoDB\Client("mongodb://localhost:27017");
    
    // Select database and collection
    $database = $mongo->selectDatabase("PricePal");
    $collection = $database->selectCollection("users");
    
    $filter = [
        'user_name' => $mail,
        'password' => $pass
    ];
    
    
    $result = $collection->findOne($filter);
    
    if ($result) {
        $_SESSION['user_name'] = $result['user_name'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['id'] = $result['id'];
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=Incorrect Username or Password");
        exit();
    }
    } 
}else{
    header("Location: index.php");
    exit();
}