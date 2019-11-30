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
        <a href="index.php">
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
if (isset($_SESSION['message'])) {
   echo "<div class='message bad'>{$_SESSION['message']}</div>";
}
?>
    <form method="POST" action="signup_handler.php">
      <div>NAME</div>
      <input type="text" name="name"/>
      <div>PASSWORD</div>
      <div><input type="password" name="password"/></div>
      <div>EMAIL</div>
      <input type="text" name="login"/>
      <div><input type="submit"/></div>
      <a href="login.php">Already have an account? Log-in</a> 
    </form>
  </body>
  <?php include("footer.php"); ?>
</html>