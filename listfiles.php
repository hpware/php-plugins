<?php
$directory = '.';
$items = scandir($directory);
$items = array_diff($items, array('.', '..'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File List</title>
    <link rel="stylesheet" href="https://hwtw.cc/style.css">
    <link rel="stylesheet" href="https://hwtw.cc/mobile-style.css">
    <style>
        body {
            text-align:left;
        }
        footer {
            text-align:center;
        }
    </style>
</head>
<body>
    <h1>
        Files in the PHP Test Site.
    </h1>
    <?php
     echo "You're currently in the ".dirname(__FILE__)." directory, Click <a href='../'>here</a> to go back";
    ?>
    <ul>
        <?php
        // Loop through the items and display them
        foreach ($items as $item) {
            $path = $directory . '/' . $item;
            if (is_dir($path)) {
                echo '<li><strong>'.htmlspecialchars($item).'</strong></li>';
                echo '<ul>';
                if ($item === $path) {
                    echo '<li><a href="'.htmlspecialchars($item).'">index.php</a></li>';
                }
                else {
                    echo '<li><a href="' . htmlspecialchars($item) . '">' . htmlspecialchars($item) . '</a></li>';
                }
                echo '</ul>';
                echo '-----------------------------------'; 
            } else {
                echo '<li><a href="' . htmlspecialchars($path) . '">' . htmlspecialchars($item) . '</a></li>';
            }
        }
        ?>
    </ul>
    <footer>
        <br><br>
        <p>&copy; 2024 Howard Wu</p>
        <p style="font-size: 0.5em;">This website is recommend to be used with Chrome or Firefox </p>
    </footer>
</body>
</html>
