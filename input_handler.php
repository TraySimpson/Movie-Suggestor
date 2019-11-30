<?php
   session_start();
   $messages = array();
   $presets = $_POST;
   $drunk = $_POST['drunk'];
   $genre = $_POST['keyword'];
   $genre = str_replace(' ', '_', $genre);

  //Example for passing message
  //  if (!is_numeric($age)) {
  //    $messages[] = "Choose a valid age";
  //    unset($presets['age']);
  //  }
  $url = "http://www.omdbapi.com/?apikey=ec8c2034&s=".$_SESSION['keyword'];
       
  $client = curl_init($url);
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  $response = curl_exec($client);

  $result = json_decode($response,true);
  $pageNum = $result['totalResults'];
  $max = floor($pageNum/10);
  if($drunk == 0){
    $offset = 1;
  } else if($drunk == 10){
    $offset = 1;
    $mov = array("1"=>"bee_movie","2"=>"shrek","3"=>"transformers");
    $randInd = rand(1,3);
    $genre = $mov[$randInd];
  } else {
    $offset = floor($max * ($drunk/10));
  }

  if($offset < 1){
    $offset = 1;
  }

   if (count($messages) > 0) {
     $_SESSION['messages'] = $messages;
     $_SESSION['form_data'] = $presets;
     header("Location: index.php");
     exit;
   }
   $_SESSION['form_data'] = $presets;
   unset($_SESSION['messages']);
//  unset($_SESSION['form_data']);
//    require_once 'Dao.php';
//    $dao = new Dao();
//    $dao->saveComment($_POST['comment']);
   $_SESSION['messages'] = array("Here's your results");
   $_SESSION['keyword'] = $genre;
   $_SESSION['offset'] = $offset;
   header("Location: index.php");
?>