<?php
   session_start();
   $messages = array();
   $presets = $_POST;
   $drunk = $_POST['drunk'];
   $genre = $_POST['keyword'];

  //Example for passing message
  //  if (!is_numeric($age)) {
  //    $messages[] = "Choose a valid age";
  //    unset($presets['age']);
  //  }

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
   header("Location: index.php");
?>