<?php

require_once 'KLogger.php';

class Dao {
    private $host = "us-cdbr-iron-east-05.cleardb.net";
    private $db = "heroku_e10210ca9b1bc08";
    private $user = "baf94a696bb20e";
    private $pass = "f0ab2de4";
    private $logger;

    public function __construct() {
        $this->logger = new KLogger ( "log.txt" , KLogger::DEBUG );
    }

    public function getConnection () {
        try{
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db}",$this->user,$this->pass);   
        }
        catch(Exception $e{
            $this->logger->LogError($e);
            echo print_r($e,1);
        }
        return $conn;
    }

    public function isValidUser($email, $password){
        $conn = $this->getConnection();
        $this->initUser();
        $check = getUser($email,$password);
        if(isset($check) && $check!=""){
            return true;
        } else {
            return false;
        }
    }

    public function checkEmail($email) {
        $conn = $this->getConnection();
        $this->initUser();
        try {
            return $conn->query("select * from user where email={$email}", PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            $this->logger->LogError($e);
            echo print_r($e,1);
            exit;
        }
    }

    public function getUser($email, $password) {
        $conn = $this->getConnection();
        $this->initUser();
        try {
            return $conn->query("select * from user where email={$email},password={$password}", PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            $this->logger->LogError($e);
            echo print_r($e,1);
            exit;
        }
      }

      public function createUser ($email, $password, $name) {
        $this->logger->LogInfo("Creating user [{$email} - {$password} - {$name}]");
        $conn = $this->getConnection();
        $this->initUser();
        $saveQuery = "insert into user (email,password,name) values (:email,:password,:name)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":email", $email);
        $q->bindParam(":password", $password);
        $q->bindParam(":name", $name);
        $q->execute();
        $this->logger->LogInfo("Successful   [{$email} - {$password} - {$name}]");
      }

      public function deleteComment ($email) {
        $conn = $this->getConnection();
        $this->logger->LogInfo("Removing user [{$email}]");
        $deleteQuery = "delete from user where email = :email";
        $q = $conn->prepare($deleteQuery);
        $q->bindParam(":email", $email);
        $q->execute();
        $this->logger->LogInfo("Removed user  [{$email}]");
      }

      public function initUser (){
          $query = "CREATE TABLE IF NOT EXISTS user (email varchar(256) NOT NULL PRIMARY KEY, 
          password varchar(64) NOT NULL, name varchar (64));";
      }
}
?>

