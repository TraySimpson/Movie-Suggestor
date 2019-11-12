<?php
session_start();
require_once 'KLogger.php';
$logger = new KLogger ( "log.txt" , KLogger::WARN );


$logger->LogInfo("Logging out user",$_SESSION['email']);
$_SESSION['logged_in'] = false;
unset($_SESSION['name']);
unset($_SESSION['email']);
header("Location: login.php");
exit;