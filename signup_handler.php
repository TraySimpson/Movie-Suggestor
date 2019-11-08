<?php
session_start();
require_once 'KLogger.php';
require_once 'Dao.php';
$dao = new Dao();
$logger = new KLogger ( "log.txt" , KLogger::WARN );
$username = $_POST['login'];
$password = $_POST['password'];
$name = $_POST['name'];

//Fix this using the database
// if ($username == "jeff" && $password == "123") {
//   $valid = true;
// }
$check = $dao->checkEmail($username);
if(isset($check) && $check==""){
    try {
        $dao->createUser($username,$password,$name);
        $user = $dao->getUser($username,$password);
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $user;
        $logger->LogInfo("User login successful [{$username}]");
        header("Location: mymovies.php");
        exit;
    } catch(Exception $e) {
        $this->logger->LogError($e);
        echo print_r($e,1);
        exit;
    }
} else {
    $logger->LogWarn("User creation failed [{$username}]");
    $_SESSION['message'] = "Invalid credentials";
    header("Location: signup.php");
    exit;
}
