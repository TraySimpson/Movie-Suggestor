<?php
session_start();
?>

<html>
<header><title>Login</title></header>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="banner">
        <a href="index.html">
            <img src="logo.png" alt="Movie Suggestor">
            <h1 class="title">Movie Suggestor</h1>
        </a>
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="trending.php">Trending</a></li>
        <li><a href="new.php">New</a></li>
        <li><a href="mymovies.php">My Movies</a></li>
        <li><a class="active" id="right" href="login.php">Log in/Sign up</a></li>
    </ul>

<?php
if( _session('logged_in')){
    header("Location: logout.php");
} 
if (isset($_SESSION['message'])) {
   echo "<div class='message bad'>{$_SESSION['message']}</div>";
}
?>
    <form method="POST" action="login_handler.php">
      <div>EMAIL</div>
      <input type="text" name="login"/>
      <div>PASSWORD</div>
      <div><input type="password" name="password"/></div>
      <div><input type="submit"/></div>
      <a href="signup.php">Create an account</a> 
    </form>
  </body>
  <?php include("footer.php"); ?>
</html>


<?php
function _session($Var, $Default=''){
    return (isset($_SESSION[$Var]) === TRUE ? $_SESSION[$Var] : $Default);
}
?>