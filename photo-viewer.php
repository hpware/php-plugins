<!doctype html>
<html>
    <head>
        <title>Photo Library Viewer</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="stylesheet" href="https://hwtw.cc/style.css">
		<link href="/favicon.ico" type="image/x-icon" />
    </head>
    <?php 
    // Obtain File via URL
    $dir = "files/";
    $files = isset($_GET['i']) ? $_GET['i'] : null;
    $error = "0";
    $not_allowed = array("http", "https", "://", "www.", "ftp.", "ftps.", "//");
    $curl_dc = curl_init("YOUR WEBHOOK HERE");
    // Collect IP address if used http or https to run a image.
    function getUserIP() {
        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
    $ip = getUserIP();
    foreach ($not_allowed as $word) {
        if (strpos($files, $word) !== false) {
            $error = "2"; 
        }
    }
    if (!$files) {
        $error = "1";
    }
    if ($error == "0") {
        $file = htmlspecialchars($dir.$files);
    }

    ?>
    <style>
            img {
        width: 70%;
        height: 70%;
        margin: 0 auto 2rem;
        transition: filter 300ms;

    }
    img:hover {
        filter: drop-shadow(0 0 2em #4c4c4caa);
    }
    </style>
    <body>
        <main>
        <h1><a class="title" href="/">Howard's Website</a></h1>
	    <h2>Photo Viewer</h2>
        <?php 
        if ($error == "1") {
            echo "<p id='Display' style='color: red;'></p>";
        } elseif ($error == "2") {
            echo "<p id='Display' style='color: red;'>Outside of the Image Library.</p>";
            $message = [
                'content' => 'Alert! Someone tried to access a file using HTTP or HTTPS. IP address: ' . $ip . ' Tried to access an internet file: ' . $files . "
                ",
                'username' => 'PHP Alert Bot',
            ];
            $jsonData = json_encode($message);
            curl_setopt($curl_dc, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_dc, CURLOPT_POST, true);
            curl_setopt($curl_dc, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($curl_dc, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($curl_dc);
            curl_close($curl_dc);
        } elseif ($error == "0") {
            echo '<img id="imageviewer" src="'.$files.'" alt="Image Viewer">';
        }
        ?>

        <br>
        <button style="border-radius:100px;" onclick="window.history.back()">Back</button>&nbsp;&nbsp;<a id="download" href=""><button style="border-radius:100px;">Download</button></a>
        </main>
        <footer>
        <br>
        <br>
            <a href="https://hwtw.cc">Home</a>&nbsp;&nbsp;<a href="https://hpware.hwtw.cc">Hpware</a>
            <br>
            <a href="https://unsplash.com/@hwtw">Unsplash</a>
            <p>Rebooted to Vercel</p>
            <p>&copy; 2024 Howard Wu</p>
        </footer>
    </body>
</html>
