<?php
session_start();
require_once 'KLogger.php';
require_once 'Dao.php';
$dao = new Dao();
$logger = new KLogger ( "log.txt" , KLogger::WARN );
$username = $_POST['login'];
$password = $_POST['password'];
$valid = $dao->isValidUser($username, $password);

//Fix this using the database
// if ($username == "jeff" && $password == "123") {
//   $valid = true;
// }

$logger->LogDebug("Clearing the session array");
$_SESSION = array();
if ($valid) {
   $user = $dao->getUser($username,$password);
   $_SESSION['logged_in'] = true;
   $_SESSION['name'] = $user;
   $logger->LogInfo("User login successful [{$username}]");
   header("Location: mymovies.php");
   exit;
} else {
   $logger->LogWarn("User login failed [{$username}]");
   $_SESSION['message'] = "Invalid username or password";
   header("Location: login.php");
   exit;
}