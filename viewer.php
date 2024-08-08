<!doctype html>
<html>
    <head>
    <title>Viewer</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://hwtw.cc/style.css">
    <link rel="stylesheet" href="https://hwtw.cc/mobile-style.css">
    <style>
        body {
            text-align:left;
        }
        footer {
            text-align:center;
        }
        a {
            font-size: 0.9em
        }
    </style>
        </style>
    </head>
    <body>
<main>
<?php 
$type = isset($_GET['t']) ? $_GET['t'] : null;
$layout = "none";
$error = "0";
if ($type === "yt") {
    $ytvID = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$ytvID) {
    $error = "1";
    } else {
    echo "<h1>Youtube Viewer</h1>
        <iframe width='560' height='315' src='https://youtube.com/embed/". htmlspecialchars($ytvID) ."' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
        <br>";};
} elseif ($type === "sptfy") {
    $sptfyID = isset($_GET['id']) ? $_GET["id"] :null;
    if (!$sptfyID) {
        $error = "1";
        }else {
        echo '<h1>Spotify Display</h1>
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/'.htmlspecialchars($sptfyID).'?utm_source=generator&theme=0" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

            <br>';}
    else {
    $error = "1";
};
if ($error === "1") {
    echo "<h1>ERROR!</h1>";
}
?>
<br><br>
<a href='/'>Go Back</a>
</main>
<footer>
        <br><br>
        <p>Powered by IIS + PHP_FastCGI</p>
        <p>&copy; 2024 Howard Wu</p>
        <p style="font-size: 0.5em;">This website is recommend to be used with Chrome or Firefox </p>
    </footer>
    </body>
</html>
