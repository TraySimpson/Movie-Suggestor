<?php

require_once 'KLogger.php';

class Dao {
    // private $host = "us-cdbr-iron-east-05.cleardb.net";
    // private $db = "heroku_550c0031a39aae3";
    // private $user = "b5c787ba788faa";
    // private $pass = "6d3d8f03";

    private $logger;

    public function __construct() {
        $this->logger = new KLogger ( "log.txt" , KLogger::DEBUG );
    }

    public function getConnection () {
        try{
            // $conn = new PDO("mysql:host={$this->host};dbname={$this->db}",$this->user,$this->pass);   
            $conn = new PDO('mysql:host=us-cdbr-iron-east-05.cleardb.net:3306;dbname=heroku_550c0031a39aae3','b5c787ba788faa','6d3d8f03');   
            // $conn = new PDO('mysql:host=localhost:3306;dbname=movie', 'root', '');
            
        }
        catch(Exception $e){
            $this->logger->LogError($e);
            echo print_r($e,1);
        }
        return $conn;
    }

    public function getUser($email, $password) {
        $conn = $this->getConnection();
        $this->initUser();
        try {
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email AND password =:password");
            $stmt->execute(['email' => $email, 'password' => $password]);
            $user = $stmt->fetch();
            return $user;
        } catch(Exception $e) {
            $this->logger->LogError($e);
            echo print_r($e,1);
            exit;
        }
      }

    public function getName($email) {
        $conn = $this->getConnection();
        $this->initUser();
        try {
            $stmt = $conn->prepare("select name from user where email= :email");
            $stmt->execute(['email' => $email]);
            $result = $stmt->fetch();
            return $result;
        } catch(Exception $e) {
            $this->logger->LogError($e);
            echo print_r($e,1);
            exit;
        }
    }


    public function isValidUser($email, $password){
        $conn = $this->getConnection();
        $this->initUser();
        $check = $this->getUser($email,$password);
        $this->logger->LogInfo("Checking valid user [{$email} - {$password} - {$check}]");
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

      public function createUser ($email, $password, $name) {
        $conn = $this->getConnection();
        $this->logger->LogInfo("Creating user [{$email} - {$password} - {$name}]");
        $this->initUser();
        $saveQuery = "insert into user (email,password,name) values (:email,:password,:name)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":email", $email);
        $q->bindParam(":password", $password);
        $q->bindParam(":name", $name);
        $q->execute();
        $this->logger->LogInfo("Successful   [{$email} - {$password} - {$name}]");
      }

      public function saveMovie ($email, $movieID) {
        $conn = $this->getConnection();
        $this->logger->LogInfo("Saving movie [{$email} - {$movieID}]");
        $saveQuery = "insert into mymovies (user,movie) values (:email,:movie)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":email", $email);
        $q->bindParam(":movie", $movieID);
        $q->execute();
      }

      public function getMovies($email) {
        $conn = $this->getConnection();
        try {
            $stmt = $conn->prepare("SELECT * FROM mymovie WHERE user = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();
            return $user;
        } catch(Exception $e) {
            $this->logger->LogError($e);
            echo print_r($e,1);
            exit;
        }
      }

      public function deleteComment ($email) {
        $conn = $this->getConnection();
        $this->logger->LogInfo("Removing user [{$email}]");
        $deleteQuery = "delete from user where email = :email";
        $q = $conn->prepare($deleteQuery);
        $q->bindParam(":email", $email);
        $q->execute();
        $this->logger->LogInfo("Removed user [{$email}]");
      }

      public function initUser (){
        $conn = $this->getConnection();
        $query = "CREATE TABLE IF NOT EXISTS user (email varchar(254) NOT NULL PRIMARY KEY, 
        password varchar(64) NOT NULL, name varchar (64));";
        $q = $conn->prepare($query);
        $q->execute();
      }
}
?>

