<?php
    session_start();
?>

<html>
<header><title>My movies</title></header>
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
        <li><a class="active" href="mymovies.php">My Movies</a></li>
        <li><a id="right" href="login.php">Log in/Sign up</a></li>
    </ul>
    <?php
        if( _session('logged_in')){
            echo "Hi ",_session('name')[0],"! ";
            echo "Here's your saved movies!";
        } else {
            echo '<a href="login.php">Log in</a> to see saved movies';
        }
    ?>
  </body>
  <?php include("footer.php"); ?>
</html>

<?php
function _session($Var, $Default=''){
    return (isset($_SESSION[$Var]) === TRUE ? $_SESSION[$Var] : $Default);
}
?>