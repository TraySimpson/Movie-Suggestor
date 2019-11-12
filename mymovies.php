<?php
    session_start();
    require_once 'Dao.php';
    $dao = new Dao();

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

        $mymovies = $dao->getMovies($_SESSION['email']);

        // if(isset($_SESSION['keyword']) && $_SESSION['keyword']!=""){
        foreach ($mymovies as $mID) {
            $url = "http://www.omdbapi.com/?apikey=ec8c2034&i=".$mID;
            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);
       
            $result = json_decode($response,true);
            
            foreach ($result['Search'] as $movie) {
                echo '<div class="tile">';
                echo '<div id="topper"><p id="movietitle">',$movie['Title'],'</p>';
                echo '<p id="movieyear">',$movie['Year'],'</p></div>';
                echo '<div class ="img_cont"><img id="poster" src="',$movie['Poster'],'"></img></div>';
                echo '</div>';

              }
        }
       
            

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