<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<header><title>New</title></header>
<head>
        <link rel="stylesheet" href="styles.css">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest"></head>
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
        <li><a class="active" href="new.php">New</a></li>
        <li><a href="mymovies.php">My Movies</a></li>
        <li><a id="right" href="login.php">Log in/Sign up</a></li>
      </ul>
      <p>New movies will go here! (Stretch goal)</p>
</body>
<?php include("footer.php"); ?>
</html>