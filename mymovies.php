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
        <li><a class="active" href="mymovies.php">My Movies</a></li>
        <li><a id="right" href="login.php">Log in/Sign up</a></li>
    </ul>
    <?php
        echo "Hi ",_session('name'),",";
    ?>
    <a>Here's your saved movies!</a>
  </body>
  <?php include("footer.php"); ?>
</html>

<?php
function _session($Var, $Default=''){
    return (isset($_SESSION['form_data'][$Var]) === TRUE ? $_SESSION['form_data'][$Var] : $Default);
}
?>