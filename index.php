<?php 
    session_start();
?>

<html>
<header><title>Home</title></header>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="banner">
        <a href="index.html">
            <img src="logo.png" alt="Movie Suggestor">
            <h1 class="title">Movie Suggestor</h1>`
        </a>
    </div>
    <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="trending.php">Trending</a></li>
        <li><a href="new.php">New</a></li>
        <li><a href="mymovies.php">My Movies</a></li>
        <li><a id="right" href="login.php">Log in/Sign up</a></li>
    </ul>
        <div class="input">
        <form action="input_handler.php" method="post">
            <div>What kind of movie do you want?</div>
            <input value="<?php echo _session('keyword') ?>" type="text" name="keyword">
            <div>How drunk do you plan on being?</div>
            <input value="<?php echo _session('drunk',0) ?>" type="range" min="0" max="10" name="drunk">
            <input type="submit">
        </form>
        </div>
        <div class="results"> 
        <?php
        // if (isset($_SESSION['messages'])) {
        // foreach ($_SESSION['messages'] as $message) {
        //     echo "<div class='message'>{$message}</div>";
        //     }
        // }

        if(isset($_SESSION['keyword']) && $_SESSION['keyword']!=""){
            $url = "http://www.omdbapi.com/?apikey=ec8c2034&s=".$_SESSION['keyword'];
       
            $client = curl_init($url);
            curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
            $response = curl_exec($client);
       
            $result = json_decode($response,true);
            //echo "<tr><td>Title:</td><td>$result</td></tr>";
            // echo "<tr><td>Year:</td><td>$movie->Year</td></tr>";
            // echo "<tr><td>Poster:</td><td>$movie->Poster</td></tr>";
            // print_r($result['Search']);
            // %?

            foreach ($result['Search'] as $movie) {
                echo '<div class="tile">';
                echo '<p id="movietitle">',$movie['Title'],'</p>';
                echo '<p id="movieyear">',$movie['Year'],'</p>';
                echo '<div class ="img_cont"><img id="poster" src="',$movie['Poster'],'"></img></div>';
                echo '</div>';

              }
        
          }
        ?>
        </div>
</body>
<?php include("footer.php"); ?>
</html>

<?php

function _post($Var, $Default=''){
    return (isset($_POST[$Var]) === TRUE ? $_POST[$Var] : $Default);
}

function _session($Var, $Default=''){
    return (isset($_SESSION['form_data'][$Var]) === TRUE ? $_SESSION['form_data'][$Var] : $Default);
}

?>